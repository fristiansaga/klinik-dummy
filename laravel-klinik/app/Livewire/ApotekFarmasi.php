<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ResepDetail;
use App\Models\Obat;
use App\Models\RekamMedis;

class ApotekFarmasi extends Component
{
    public $searchObat = '';
    public $golonganFilter = 'semua'; // 'semua', 'Generik', 'Paten / Bermerek', 'BHP'
    public $alertSuccess = '';

    // Modal Tambah Obat Baru
    public $showAddModal = false;
    public $new_kode_obat = '';
    public $new_nama_obat = '';
    public $new_merek = '';
    public $new_produsen = '';
    public $new_golongan_obat = 'Generik';
    public $new_kategori = 'Tablet';
    public $new_satuan = 'Strip';
    public $new_stok = 50;
    public $new_harga_beli = 5000;
    public $new_harga_jual = 7500;
    public $new_tgl_kadaluarsa = '2028-12-31';
    public $new_lokasi_rak = 'RAK-A1';

    public function openAddModal()
    {
        $this->new_kode_obat = 'OBT-' . rand(1000, 9999);
        $this->showAddModal = true;
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
    }

    public function simpanObatBaru()
    {
        $this->validate([
            'new_kode_obat' => 'required',
            'new_nama_obat' => 'required|min:3',
            'new_stok' => 'required|numeric|min:0',
            'new_harga_jual' => 'required|numeric|min:0',
        ]);

        Obat::create([
            'kode_obat' => $this->new_kode_obat,
            'nama_obat' => $this->new_nama_obat,
            'merek' => $this->new_merek ?: '-',
            'produsen' => $this->new_produsen ?: 'Kimia Farma',
            'golongan_obat' => $this->new_golongan_obat,
            'kategori' => $this->new_kategori,
            'satuan' => $this->new_satuan,
            'stok' => $this->new_stok,
            'min_stok' => 10,
            'harga_beli' => $this->new_harga_beli,
            'harga_jual' => $this->new_harga_jual,
            'tgl_kadaluarsa' => $this->new_tgl_kadaluarsa,
            'lokasi_rak' => $this->new_lokasi_rak,
        ]);

        $this->showAddModal = false;
        $this->alertSuccess = "Obat baru '{$this->new_nama_obat}' (Merek: {$this->new_merek}) berhasil ditambahkan ke inventaris!";
        
        // Reset form
        $this->reset(['new_nama_obat', 'new_merek', 'new_produsen']);
    }

    public function prosesTebus($resepId)
    {
        $resep = ResepDetail::findOrFail($resepId);
        
        // Kurangi stok obat
        if ($resep->obat_id) {
            $obat = Obat::find($resep->obat_id);
            if ($obat && $obat->stok >= $resep->jumlah) {
                $obat->decrement('stok', $resep->jumlah);
            }
        }

        $resep->update(['status_tebus' => 'selesai']);
        $this->alertSuccess = "Resep atas obat {$resep->nama_obat} berhasil diproses dan stok dikurangi!";
    }

    public function render()
    {
        $antrianResep = ResepDetail::with(['rekamMedis.pasien', 'obat'])
            ->where('status_tebus', 'pending')
            ->latest()
            ->get();

        $katalogObat = Obat::query()
            ->when($this->searchObat, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('nama_obat', 'like', '%' . $this->searchObat . '%')
                        ->orWhere('merek', 'like', '%' . $this->searchObat . '%')
                        ->orWhere('produsen', 'like', '%' . $this->searchObat . '%')
                        ->orWhere('kode_obat', 'like', '%' . $this->searchObat . '%');
                });
            })
            ->when($this->golonganFilter !== 'semua', function ($q) {
                $q->where('golongan_obat', $this->golonganFilter);
            })
            ->orderBy('nama_obat', 'asc')
            ->get();

        return view('livewire.apotek-farmasi', [
            'antrianResep' => $antrianResep,
            'katalogObat' => $katalogObat,
        ]);
    }
}

