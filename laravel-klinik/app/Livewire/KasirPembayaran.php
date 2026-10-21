<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;

class KasirPembayaran extends Component
{
    public $selectedTransaksiId = null;
    public $currentTransaksi = null;
    public $jumlahBayar = 0;
    public $metodePembayaran = 'Tunai';
    public $alertSuccess = '';

    // Struk Modal States
    public $showStrukModal = false;
    public $strukData = null;
    public $activeTab = 'pending'; // 'pending' | 'history'
    public $searchHistory = '';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function selectTransaksi($id)
    {
        $this->selectedTransaksiId = $id;
        $this->currentTransaksi = Transaksi::with(['pasien', 'rekamMedis.dokter', 'rekamMedis.resepDetails.obat', 'rekamMedis.antrian.poli'])->findOrFail($id);
        $this->jumlahBayar = $this->currentTransaksi->total_tagihan;
    }

    public function prosesBayar()
    {
        if (!$this->currentTransaksi) return;

        $kembalian = max(0, $this->jumlahBayar - $this->currentTransaksi->total_tagihan);

        $this->currentTransaksi->update([
            'jumlah_bayar' => $this->jumlahBayar,
            'kembalian' => $kembalian,
            'metode_pembayaran' => $this->metodePembayaran,
            'status_pembayaran' => 'lunas',
        ]);

        // Load complete data for receipt/struk printing
        $this->strukData = Transaksi::with(['pasien', 'rekamMedis.dokter', 'rekamMedis.resepDetails.obat', 'rekamMedis.antrian.poli'])->findOrFail($this->currentTransaksi->id);
        $this->showStrukModal = true;
        
        $this->alertSuccess = "Pembayaran Kwitansi {$this->strukData->no_kwitansi} Lunas!";
        $this->selectedTransaksiId = null;
        $this->currentTransaksi = null;

        $this->dispatch('open-struk');
    }

    public function cetakStruk($id)
    {
        $this->strukData = Transaksi::with(['pasien', 'rekamMedis.dokter', 'rekamMedis.resepDetails.obat', 'rekamMedis.antrian.poli'])->findOrFail($id);
        $this->showStrukModal = true;
        $this->dispatch('open-struk');
    }

    public function closeStruk()
    {
        $this->showStrukModal = false;
        $this->strukData = null;
    }

    public function render()
    {
        $tagihanPending = Transaksi::with(['pasien', 'rekamMedis.dokter', 'rekamMedis.antrian.poli'])
            ->where('status_pembayaran', 'pending')
            ->latest()
            ->get();

        $transaksiSelesai = Transaksi::with(['pasien', 'rekamMedis.dokter', 'rekamMedis.antrian.poli', 'rekamMedis.resepDetails'])
            ->where('status_pembayaran', 'lunas')
            ->when($this->searchHistory, function($q) {
                $q->where('no_kwitansi', 'like', '%' . $this->searchHistory . '%')
                  ->orWhereHas('pasien', function($p) {
                      $p->where('nama_lengkap', 'like', '%' . $this->searchHistory . '%')
                        ->orWhere('no_rm', 'like', '%' . $this->searchHistory . '%');
                  });
            })
            ->latest()
            ->take(20)
            ->get();

        return view('livewire.kasir-pembayaran', [
            'tagihanPending' => $tagihanPending,
            'transaksiSelesai' => $transaksiSelesai,
        ]);
    }
}

