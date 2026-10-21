<?php

namespace App\Livewire;

use Livewire\Component;

class PortalPasien extends Component
{
    public $activeTab = 'passport'; // passport, riwayat, rujukan, booking, antrean
    public $showPrintModal = false;
    public $printType = ''; // 'riwayat' | 'rujukan'
    
    // Patient Data (SATUSEHAT & Rekam Medis)
    public $patient = [
        'nama' => 'Achmad Nurhadi',
        'no_rm' => 'RM-2026-0881',
        'nik' => '3175081205900001',
        'bpjs' => '0001892837482',
        'penjamin' => 'BPJS Kesehatan',
        'ihs_id' => 'P-8829103991',
        'gol_darah' => 'O (Positif)',
        'tgl_lahir' => '12 Mei 1990 (36 Th)',
        'alergi' => 'Amoxicillin, Seafood',
        'antrean_hari_ini' => 'A-004',
        'poli_antrean' => 'Poli Umum',
        'sisa_antrean' => 1,
        'tekanan_darah' => '120 / 80 mmHg',
        'lab_poct' => [
            'gds' => ['val' => 110, 'unit' => 'mg/dL', 'status' => 'Normal'],
            'kolesterol' => ['val' => 175, 'unit' => 'mg/dL', 'status' => 'Normal'],
            'asam_urat' => ['val' => 5.4, 'unit' => 'mg/dL', 'status' => 'Normal']
        ]
    ];

    // Riwayat Penyakit & Rekam Medis Kronologis
    public $riwayatMedis = [
        [
            'id' => 1,
            'tanggal' => '30 Agustus 2026',
            'poli' => 'Poli Umum',
            'dokter' => 'dr. Agus Susanto, Sp.PD',
            'keluhan' => 'Pusing berputar, leher kaku, dan mudah lelah setelah latihan fisik',
            'diagnosa' => 'Essential (Primary) Hypertension',
            'icd10' => 'I10',
            'vital_sign' => 'TD: 140/90 mmHg | Nadi: 82x/m | Suhu: 36.6°C | BB: 68 Kg',
            'lab' => 'GDS: 110 mg/dL | Kolesterol: 175 mg/dL | Asam Urat: 5.4 mg/dL',
            'terapi' => 'Amlodipine 5mg (1x1), Vitamin B Kompleks (1x1), Edukasi diet rendah garam',
            'status' => 'Selesai Rawat Jalan',
        ],
        [
            'id' => 2,
            'tanggal' => '15 Juli 2026',
            'poli' => 'Poli Gigi & Mulut',
            'dokter' => 'drg. Budi Santoso',
            'keluhan' => 'Gigi geraham bawah ngilu saat minum dingin',
            'diagnosa' => 'Dental Caries of Dentin',
            'icd10' => 'K02.1',
            'vital_sign' => 'TD: 120/80 mmHg | Suhu: 36.5°C',
            'lab' => '-',
            'terapi' => 'Penambalan Gigi Komposit Light-Cured, Asam Mefenamat 500mg prn',
            'status' => 'Selesai Tindakan',
        ],
        [
            'id' => 3,
            'tanggal' => '04 Mei 2026',
            'poli' => 'Poli Penyakit Dalam',
            'dokter' => 'dr. Agus Susanto, Sp.PD',
            'keluhan' => 'Batuk berdahak 4 hari, demam ringan hilang timbul',
            'diagnosa' => 'Acute Upper Respiratory Infection, Unspecified',
            'icd10' => 'J06.9',
            'vital_sign' => 'TD: 120/80 mmHg | Suhu: 37.8°C',
            'lab' => 'Leukosit: 8.500 /uL | Hb: 14.5 g/dL',
            'terapi' => 'Paracetamol 500mg (3x1), Ambroxol 30mg (3x1), Cetirizine 10mg (1x1 malam)',
            'status' => 'Selesai Rawat Jalan',
        ]
    ];

    // Data Surat Rujukan Medis Aktif
    public $suratRujukan = [
        'no_rujukan' => 'RUJ-20260830-0019',
        'tgl_rujukan' => '30 Agustus 2026',
        'berlaku_sampai' => '30 November 2026 (90 Hari)',
        'faskes_perujuk' => 'KLINIK PRATAMA PUSDIKZI TNI AD (0115B001)',
        'faskes_tujuan' => 'RS Tk. IV 03.04.02 Salak Bogor (RST Salak)',
        'poli_tujuan' => 'Spesialis Jantung & Pembuluh Darah (Kardiologi)',
        'diagnosa_utama' => 'Hypertensive Heart Disease without HF (ICD-10: I11.9)',
        'alasan_rujuk' => 'Pemeriksaan Ekokardiografi & Treadmill Test untuk evaluasi kardiomegali awal.',
        'terapi_sementara' => 'Amlodipine 5mg tab (1x1 pagi), Captopril 25mg prn',
        'dokter_perujuk' => 'dr. Agus Susanto, Sp.PD (SIP: 446.1/082/SIP-D/2024)',
        'status_rujukan' => 'Aktif / Terverifikasi TTE SATUSEHAT'
    ];

    // Booking Form
    public $poliTujuan = 'Poli Umum';
    public $dokterTujuan = 'dr. Agus Susanto, Sp.PD';
    public $tglBooking = '2026-08-30';
    public $penjaminBooking = 'BPJS Kesehatan';
    public $keluhan = '';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function cetakRiwayat()
    {
        $this->printType = 'riwayat';
        $this->showPrintModal = true;
        $this->dispatch('open-struk');
    }

    public function cetakRujukan()
    {
        $this->printType = 'rujukan';
        $this->showPrintModal = true;
        $this->dispatch('open-struk');
    }

    public function closePrintModal()
    {
        $this->showPrintModal = false;
        $this->printType = '';
    }

    public function submitBooking()
    {
        $this->validate([
            'poliTujuan' => 'required',
            'dokterTujuan' => 'required',
            'tglBooking' => 'required|date',
            'keluhan' => 'required|min:5',
        ]);

        $this->patient['antrean_hari_ini'] = 'A-005';
        $this->activeTab = 'antrean';
        
        session()->flash('success', 'Reservasi Berhasil! Nomor Antrean Anda: A-005.');
    }

    public function render()
    {
        return view('livewire.portal-pasien')->layout('layouts.app', ['title' => 'Digital Health Passport Pasien - KLINIK PUSDIKZI']);
    }
}

