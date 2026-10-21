<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\RekamMedis;
use App\Models\Transaksi;
use App\Models\Obat;
use Carbon\Carbon;

class DashboardKlinik extends Component
{
    public function render()
    {
        $today = Carbon::today();

        $totalPasien = Pasien::count();
        $antrianHariIni = Antrian::whereDate('waktu_daftar', $today)->count();
        $antrianSelesai = Antrian::whereDate('waktu_daftar', $today)->where('status', 'selesai')->count();
        $antrianMenunggu = Antrian::whereDate('waktu_daftar', $today)->whereIn('status', ['menunggu', 'dipanggil', 'diperiksa'])->count();
        
        $pendapatanHariIni = Transaksi::whereDate('created_at', $today)
            ->where('status_pembayaran', 'lunas')
            ->sum('total_tagihan');

        $obatKritis = Obat::whereColumn('stok', '<=', 'min_stok')->take(5)->get();

        $antrianTerbaru = Antrian::with(['pasien', 'poli', 'dokter'])
            ->whereDate('waktu_daftar', $today)
            ->latest()
            ->take(6)
            ->get();

        return view('livewire.dashboard-klinik', [
            'totalPasien' => $totalPasien,
            'antrianHariIni' => $antrianHariIni,
            'antrianSelesai' => $antrianSelesai,
            'antrianMenunggu' => $antrianMenunggu,
            'pendapatanHariIni' => $pendapatanHariIni,
            'obatKritis' => $obatKritis,
            'antrianTerbaru' => $antrianTerbaru,
        ]);
    }
}
