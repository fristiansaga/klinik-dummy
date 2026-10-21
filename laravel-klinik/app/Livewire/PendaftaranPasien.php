<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Antrian;
use Carbon\Carbon;

class PendaftaranPasien extends Component
{
    use WithPagination;

    // Search and filter
    public $search = '';
    public $filterKategori = '';

    // Form inputs
    public $isPasienBaru = false;
    public $pasien_id = null;
    
    // Pasien data
    public $no_rm = '';
    public $nik = '';
    public $nama_lengkap = '';
    public $jenis_kelamin = 'Laki-laki';
    public $tanggal_lahir = '';
    public $tempat_lahir = 'Bogor';
    public $golongan_darah = 'O';
    public $alamat = '';
    public $no_telepon = '';
    public $kategori_pasien = 'Umum';
    public $nrp_nip = '';
    public $kesatuan = '';
    public $pangkat = '';
    public $no_bpjs = '';
    public $riwayat_alergi = '';

    // Antrian inputs
    public $poli_id = '';
    public $dokter_id = '';
    public $keluhan_utama = '';
    public $tensi = '120/80';
    public $suhu = '36.5';
    public $berat_badan = '65';
    public $tinggi_badan = '170';

    public $alertSuccess = '';
    public $showTiketModal = false;
    public $lastAntrian = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $firstPoli = Poli::first();
        if ($firstPoli) {
            $this->poli_id = $firstPoli->id;
        }
    }

    public function generateNoRM()
    {
        $count = Pasien::count() + 1;
        return 'RM-' . str_pad($count, 5, '0', STR_PAD_LEFT);
    }

    public function generateNomorAntrian($poliId)
    {
        $poli = Poli::find($poliId);
        $prefix = $poli ? strtoupper(substr($poli->kode_poli, 0, 1)) : 'A';
        $todayCount = Antrian::whereDate('waktu_daftar', Carbon::today())
            ->where('poli_id', $poliId)
            ->count() + 1;
        return $prefix . '-' . str_pad($todayCount, 3, '0', STR_PAD_LEFT);
    }

    public function pilihPasienLama($id)
    {
        $pasien = Pasien::findOrFail($id);
        $this->pasien_id = $pasien->id;
        $this->no_rm = $pasien->no_rm;
        $this->nik = $pasien->nik;
        $this->nama_lengkap = $pasien->nama_lengkap;
        $this->kategori_pasien = $pasien->kategori_pasien;
        $this->riwayat_alergi = $pasien->riwayat_alergi;
        $this->isPasienBaru = false;
    }

    public function simpanPendaftaran()
    {
        $this->validate([
            'poli_id' => 'required',
            'keluhan_utama' => 'required|min:3',
        ]);

        if ($this->isPasienBaru || !$this->pasien_id) {
            $this->validate([
                'nik' => 'required|numeric|digits:16|unique:pasiens,nik',
                'nama_lengkap' => 'required|min:3',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required',
            ]);

            $pasien = Pasien::create([
                'no_rm' => $this->generateNoRM(),
                'nik' => $this->nik,
                'nama_lengkap' => $this->nama_lengkap,
                'jenis_kelamin' => $this->jenis_kelamin,
                'tanggal_lahir' => $this->tanggal_lahir,
                'tempat_lahir' => $this->tempat_lahir,
                'golongan_darah' => $this->golongan_darah,
                'alamat' => $this->alamat,
                'no_telepon' => $this->no_telepon,
                'kategori_pasien' => $this->kategori_pasien,
                'nrp_nip' => $this->nrp_nip,
                'kesatuan' => $this->kesatuan,
                'pangkat' => $this->pangkat,
                'no_bpjs' => $this->no_bpjs,
                'riwayat_alergi' => $this->riwayat_alergi,
            ]);

            $this->pasien_id = $pasien->id;
        }

        $nomorAntrian = $this->generateNomorAntrian($this->poli_id);

        $antrian = Antrian::create([
            'nomor_antrian' => $nomorAntrian,
            'pasien_id' => $this->pasien_id,
            'poli_id' => $this->poli_id,
            'dokter_id' => $this->dokter_id ?: null,
            'status' => 'menunggu',
            'waktu_daftar' => now(),
            'keluhan_utama' => $this->keluhan_utama,
            'tensi' => $this->tensi,
            'suhu' => $this->suhu,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
        ]);

        $this->lastAntrian = Antrian::with(['pasien', 'poli', 'dokter'])->find($antrian->id);
        $this->showTiketModal = true;

        $this->alertSuccess = "Pendaftaran Berhasil! Nomor Antrian: {$nomorAntrian}";
        $this->reset(['pasien_id', 'nik', 'nama_lengkap', 'keluhan_utama', 'isPasienBaru']);
        $this->dispatch('open-struk');
    }

    public function cetakTiketAntrian($antrianId)
    {
        $this->lastAntrian = Antrian::with(['pasien', 'poli', 'dokter'])->findOrFail($antrianId);
        $this->showTiketModal = true;
        $this->dispatch('open-struk');
    }

    public function closeTiket()
    {
        $this->showTiketModal = false;
        $this->lastAntrian = null;
    }

    public function render()
    {
        $pasiens = Pasien::query()
            ->when($this->search, function ($query) {
                $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                      ->orWhere('nik', 'like', '%' . $this->search . '%')
                      ->orWhere('no_rm', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterKategori, function ($query) {
                $query->where('kategori_pasien', $this->filterKategori);
            })
            ->latest()
            ->paginate(6);

        $polis = Poli::where('status_aktif', true)->get();
        $dokters = Dokter::where('status_aktif', true)->get();

        return view('livewire.pendaftaran-pasien', [
            'pasiens' => $pasiens,
            'polis' => $polis,
            'dokters' => $dokters,
        ]);
    }
}
