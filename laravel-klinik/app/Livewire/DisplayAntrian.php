<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Antrian;
use App\Models\Poli;
use Carbon\Carbon;

class DisplayAntrian extends Component
{
    public $selectedPoliId = 'all';

    public function panggilNomor($antrianId)
    {
        $antrian = Antrian::findOrFail($antrianId);
        $antrian->update([
            'status' => 'dipanggil',
            'waktu_panggil' => now(),
        ]);

        // Dispatch browser event untuk Text-to-Speech / Bell Chime
        $this->dispatch('bunyikan-panggilan', [
            'nomor' => $antrian->nomor_antrian,
            'poli' => $antrian->poli->nama_poli,
            'nama' => $antrian->pasien->nama_lengkap
        ]);
    }

    public function selesaiPemeriksaan($antrianId)
    {
        $antrian = Antrian::findOrFail($antrianId);
        $antrian->update([
            'status' => 'selesai',
            'waktu_selesai' => now(),
        ]);
    }

    public function render()
    {
        $today = Carbon::today();

        $antrianSedangDipanggil = Antrian::with(['pasien', 'poli', 'dokter'])
            ->whereDate('waktu_daftar', $today)
            ->where('status', 'dipanggil')
            ->latest('waktu_panggil')
            ->first();

        $antrianPerPoli = Poli::with(['antrians' => function ($q) use ($today) {
            $q->whereDate('waktu_daftar', $today)
              ->whereIn('status', ['menunggu', 'dipanggil', 'diperiksa'])
              ->orderBy('id', 'asc');
        }])->get();

        $antrianMenungguList = Antrian::with(['pasien', 'poli'])
            ->whereDate('waktu_daftar', $today)
            ->where('status', 'menunggu')
            ->when($this->selectedPoliId !== 'all', function ($q) {
                $q->where('poli_id', $this->selectedPoliId);
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.display-antrian', [
            'antrianSedangDipanggil' => $antrianSedangDipanggil,
            'antrianPerPoli' => $antrianPerPoli,
            'antrianMenungguList' => $antrianMenungguList,
            'polis' => Poli::all(),
        ]);
    }
}
