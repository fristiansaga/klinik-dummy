<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Antrian;
use App\Models\RekamMedis;
use App\Models\Obat;
use App\Models\ResepDetail;
use App\Models\Transaksi;
use Carbon\Carbon;

class PemeriksaanDokter extends Component
{
    public $selectedAntrianId = null;
    public $currentAntrian = null;

    // SOAP fields
    public $subjektif = '';
    public $objektif = '';
    public $tekanan_darah = '120/80';
    public $suhu = '36.5';
    public $nadi = '80';
    public $pernapasan = '18';
    public $berat_badan = '65';
    public $tinggi_badan = '170';

    // Diagnosa & Tindakan
    public $kode_icd10 = 'I10';
    public $nama_diagnosa = 'Essential (primary) hypertension';
    public $tindakan_icd9 = 'General medical examination (89.07)';
    public $catatan_dokter = '';
    public $status_pelayanan = 'selesai'; // 'selesai', 'rawat_inap', 'rujuk'

    // Form Rujukan Medis
    public $rs_rujukan = 'RS Tk. IV 03.04.02 Salak Bogor (RST Salak)';
    public $poli_rujukan = 'Spesialis Penyakit Dalam (Sp.PD)';
    public $alasan_rujukan = 'Pemeriksaan lanjutan & penanganan spesialis';
    public $showRujukanModal = false;
    public $lastRujukanData = null;

    // e-Resep list
    public $resepItems = [];
    public $selectedObatId = '';
    public $obatJumlah = 10;
    public $aturanPakai = '3x1 sesudah makan';

    public $alertSuccess = '';

    public function selectAntrian($id)
    {
        $this->selectedAntrianId = $id;
        $this->currentAntrian = Antrian::with(['pasien', 'poli'])->findOrFail($id);
        
        $this->subjektif = $this->currentAntrian->keluhan_utama;
        $this->tekanan_darah = $this->currentAntrian->tensi ?: '120/80';
        $this->suhu = $this->currentAntrian->suhu ?: '36.5';
        $this->berat_badan = $this->currentAntrian->berat_badan ?: '65';
        $this->tinggi_badan = $this->currentAntrian->tinggi_badan ?: '170';
        $this->resepItems = [];
    }

    public function tambahObatResep()
    {
        if (!$this->selectedObatId) return;

        $obat = Obat::findOrFail($this->selectedObatId);
        $this->resepItems[] = [
            'obat_id' => $obat->id,
            'nama_obat' => $obat->nama_obat,
            'jumlah' => $this->obatJumlah,
            'aturan_pakai' => $this->aturanPakai,
            'harga_satuan' => $obat->harga_jual,
            'total_harga' => $obat->harga_jual * $this->obatJumlah,
        ];

        $this->selectedObatId = '';
    }

    public function hapusObatResep($index)
    {
        unset($this->resepItems[$index]);
        $this->resepItems = array_values($this->resepItems);
    }

    public function simpanPemeriksaan()
    {
        if (!$this->currentAntrian) return;

        $noTransaksi = 'TRX-' . date('Ymd') . '-' . str_pad($this->currentAntrian->id, 4, '0', STR_PAD_LEFT);

        $rekamMedis = RekamMedis::create([
            'no_transaksi' => $noTransaksi,
            'pasien_id' => $this->currentAntrian->pasien_id,
            'dokter_id' => $this->currentAntrian->dokter_id ?: 1,
            'antrian_id' => $this->currentAntrian->id,
            'tanggal_periksa' => now(),
            'subjektif_keluhan' => $this->subjektif,
            'objektif_fisik' => $this->objektif,
            'tekanan_darah' => $this->tekanan_darah,
            'suhu_tubuh' => $this->suhu,
            'nadi' => $this->nadi,
            'pernapasan' => $this->pernapasan,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
            'kode_icd10' => $this->kode_icd10,
            'nama_diagnosa' => $this->nama_diagnosa,
            'tindakan_icd9' => $this->tindakan_icd9,
            'catatan_dokter' => $this->catatan_dokter,
            'status_pelayanan' => $this->status_pelayanan,
        ]);

        $totalBiayaObat = 0;
        foreach ($this->resepItems as $item) {
            ResepDetail::create([
                'rekam_medis_id' => $rekamMedis->id,
                'obat_id' => $item['obat_id'],
                'nama_obat' => $item['nama_obat'],
                'jumlah' => $item['jumlah'],
                'aturan_pakai' => $item['aturan_pakai'],
                'harga_satuan' => $item['harga_satuan'],
                'total_harga' => $item['total_harga'],
                'status_tebus' => 'pending',
            ]);
            $totalBiayaObat += $item['total_harga'];
        }

        // Generate Billing Kasir
        $biayaKonsultasi = 35000;
        $biayaTindakan = 25000;
        $isTniOrBpjs = in_array($this->currentAntrian->pasien->kategori_pasien, ['Militer PUSDIKZI', 'BPJS Kesehatan']);
        $totalTagihan = $isTniOrBpjs ? 0 : ($biayaKonsultasi + $biayaTindakan + $totalBiayaObat);

        Transaksi::create([
            'no_kwitansi' => 'KWT-' . date('Ymd') . '-' . str_pad($this->currentAntrian->id, 4, '0', STR_PAD_LEFT),
            'rekam_medis_id' => $rekamMedis->id,
            'pasien_id' => $this->currentAntrian->pasien_id,
            'biaya_konsultasi' => $biayaKonsultasi,
            'biaya_tindakan' => $biayaTindakan,
            'biaya_obat' => $totalBiayaObat,
            'total_tagihan' => $totalTagihan,
            'status_pembayaran' => $isTniOrBpjs ? 'lunas' : 'pending',
            'metode_pembayaran' => $isTniOrBpjs ? 'Ditanggung Dinas / BPJS' : 'Tunai',
        ]);

        // If patient is referred (Rujuk), prepare printable referral data
        if ($this->status_pelayanan === 'rujuk') {
            $this->lastRujukanData = [
                'no_rujukan' => 'RUJ-' . date('Ymd') . '-' . str_pad($this->currentAntrian->id, 4, '0', STR_PAD_LEFT),
                'pasien' => $this->currentAntrian->pasien,
                'diagnosa' => $this->nama_diagnosa,
                'icd10' => $this->kode_icd10,
                'rs_rujukan' => $this->rs_rujukan,
                'poli_rujukan' => $this->poli_rujukan,
                'alasan' => $this->alasan_rujukan,
                'tgl_rujukan' => date('d F Y'),
                'berlaku' => date('d F Y', strtotime('+90 days')),
                'resep' => $this->resepItems,
            ];
            $this->showRujukanModal = true;
            $this->dispatch('open-struk');
        }

        $this->currentAntrian->update(['status' => 'selesai', 'waktu_selesai' => now()]);

        $this->alertSuccess = "Pemeriksaan dan Rekam Medis berhasil disimpan!" . ($this->status_pelayanan === 'rujuk' ? " Surat Rujukan telah diterbitkan." : "");
        $this->selectedAntrianId = null;
        $this->currentAntrian = null;
    }

    public function closeRujukanModal()
    {
        $this->showRujukanModal = false;
        $this->lastRujukanData = null;
    }

    public function render()
    {
        $today = Carbon::today();
        
        $antrianAktif = Antrian::with(['pasien', 'poli'])
            ->whereDate('waktu_daftar', $today)
            ->whereIn('status', ['dipanggil', 'menunggu'])
            ->orderBy('id', 'asc')
            ->get();

        $daftarObat = Obat::where('stok', '>', 0)->get();

        return view('livewire.pemeriksaan-dokter', [
            'antrianAktif' => $antrianAktif,
            'daftarObat' => $daftarObat,
        ]);
    }
}
