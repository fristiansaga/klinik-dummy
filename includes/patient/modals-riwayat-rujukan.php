<!-- Modal Popup 1: Cetak Resume Riwayat Rekam Medis Pasien -->
<div class="modal-overlay" id="riwayat-modal-overlay">
  <div class="modal-card" style="max-width: 680px; padding: 2.25rem; background: #FFFFFF !important; color: #0F172A !important; border-radius: var(--radius-xl); box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
    <div id="printable-riwayat-content">
      <!-- KOP Surat Resmi -->
      <div style="border-bottom: 2px solid #0F172A; padding-bottom: 0.75rem; margin-bottom: 1.25rem; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <div style="width: 44px; height: 44px; border-radius: 8px; background: #1E3926; color: #FFF; display: flex; align-items: center; justify-content: center; font-weight: 900;">
            <i data-lucide="cross" style="width: 24px; height: 24px;"></i>
          </div>
          <div>
            <h3 style="margin: 0; font-size: 1.1rem; color: #0F172A; font-weight: 900; letter-spacing: -0.01em;">KLINIK PRATAMA PUSDIKZI</h3>
            <p style="margin: 0; font-size: 0.75rem; font-weight: 700; color: #1E3926;">PUSAT PENDIDIKAN ZENI TNI ANGKATAN DARAT</p>
            <small style="color: #64748B; font-size: 0.7rem;">Jl. Jenderal Sudirman No. 35, Bogor Tengah • Telp: (0251) 832-1234</small>
          </div>
        </div>
        <div style="text-align: right;">
          <span style="background: #DCFCE7; color: #166534; font-size: 0.75rem; font-weight: 800; padding: 3px 8px; border-radius: 4px; font-family: monospace;">RM-2026-0881</span>
        </div>
      </div>

      <div style="text-align: center; margin-bottom: 1.25rem;">
        <h4 style="margin: 0; font-size: 1.15rem; font-weight: 900; text-decoration: underline; color: #0F172A; text-transform: uppercase;">RESUME RIWAYAT REKAM MEDIS PASIEN</h4>
        <small style="color: #64748B; font-size: 0.75rem;">Kompilasi Rekam Medis Terpadu SATUSEHAT Kemenkes RI</small>
      </div>

      <!-- Identitas Pasien -->
      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.35rem;">
          <div><span>Nama Pasien:</span> <strong>Achmad Nurhadi</strong></div>
          <div><span>NIK / IHS:</span> <strong style="font-family: monospace;">3175081205900001 / P-8829103991</strong></div>
          <div><span>Penjamin:</span> <strong>BPJS Kesehatan (0001892837482)</strong></div>
          <div><span>Gol. Darah / Tgl Lahir:</span> <strong>O (Positif) / 12 Mei 1990 (36 Th)</strong></div>
          <div style="grid-column: span 2; color: #B91C1C; font-weight: 600;"><span>Alergi:</span> Amoxicillin, Seafood</div>
        </div>
      </div>

      <!-- Tabel Kronologi -->
      <table style="width: 100%; border-collapse: collapse; font-size: 0.8rem; margin-bottom: 1rem; border: 1px solid #CBD5E1;">
        <thead>
          <tr style="background: #F1F5F9; border-bottom: 1px solid #CBD5E1; text-align: left;">
            <th style="padding: 6px 8px;">Tgl / Poli</th>
            <th style="padding: 6px 8px;">Diagnosa (ICD-10)</th>
            <th style="padding: 6px 8px;">Tanda Vital & Lab</th>
            <th style="padding: 6px 8px;">Terapi Obat</th>
          </tr>
        </thead>
        <tbody>
          <tr style="border-bottom: 1px solid #E2E8F0;">
            <td style="padding: 6px 8px; vertical-align: top;"><strong>30 Agu 2026</strong><br/><small style="color: #64748B;">Poli Penyakit Dalam</small></td>
            <td style="padding: 6px 8px; vertical-align: top;"><strong>Essential Hypertension</strong><br/><small style="font-family: monospace; color: #1E3926;">(I10)</small></td>
            <td style="padding: 6px 8px; vertical-align: top;">TD: 140/90 mmHg<br/>Lab: GDS 110 mg/dL</td>
            <td style="padding: 6px 8px; vertical-align: top;">Amlodipine 5mg (1x1), Vit B Kompleks</td>
          </tr>
          <tr style="border-bottom: 1px solid #E2E8F0;">
            <td style="padding: 6px 8px; vertical-align: top;"><strong>15 Jul 2026</strong><br/><small style="color: #64748B;">Poli Gigi</small></td>
            <td style="padding: 6px 8px; vertical-align: top;"><strong>Dental Caries</strong><br/><small style="font-family: monospace; color: #1E3926;">(K02.1)</small></td>
            <td style="padding: 6px 8px; vertical-align: top;">TD: 120/80 mmHg</td>
            <td style="padding: 6px 8px; vertical-align: top;">Tambal Gigi Komposit, Asam Mefenamat</td>
          </tr>
          <tr>
            <td style="padding: 6px 8px; vertical-align: top;"><strong>04 Mei 2026</strong><br/><small style="color: #64748B;">Poli Umum</small></td>
            <td style="padding: 6px 8px; vertical-align: top;"><strong>ISPA Akut</strong><br/><small style="font-family: monospace; color: #1E3926;">(J06.9)</small></td>
            <td style="padding: 6px 8px; vertical-align: top;">TD: 120/80, Suhu: 37.8°C</td>
            <td style="padding: 6px 8px; vertical-align: top;">Paracetamol 500mg, Ambroxol 30mg</td>
          </tr>
        </tbody>
      </table>

      <!-- Tanda Tangan Dokter -->
      <div style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid #E2E8F0; padding-top: 1rem; font-size: 0.82rem;">
        <div style="font-size: 0.75rem; color: #64748B;">
          <p style="margin: 0;">Dokumen rekam medis terverifikasi elektronik.</p>
          <span style="font-family: monospace;">TTE SATUSEHAT: PZ-MED-VALID-2026</span>
        </div>
        <div style="text-align: center;">
          <p style="margin: 0 0 1.5rem 0; font-size: 0.78rem;">Bogor, 30 Agustus 2026<br/>Dokter Penanggung Jawab Pelayanan,</p>
          <strong style="color: #0F172A; display: block; border-bottom: 1px solid #0F172A;">dr. Agus Susanto, Sp.PD</strong>
          <small style="color: #64748B; font-size: 0.72rem;">SIP: 446.1/082/SIP-D/2024</small>
        </div>
      </div>
    </div>

    <div class="flex gap-2" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
      <button class="btn btn-primary btn-sm flex items-center justify-center gap-1" style="flex: 1;" onclick="window.print()">
        <i data-lucide="printer"></i> Cetak Lembar Riwayat (Print / PDF)
      </button>
      <button class="btn btn-outline btn-sm" style="flex: 1;" onclick="document.getElementById('riwayat-modal-overlay').classList.remove('open')">
        Tutup
      </button>
    </div>
  </div>
</div>

<!-- Modal Popup 2: Cetak Surat Rujukan Medis Pasien -->
<div class="modal-overlay" id="rujukan-modal-overlay">
  <div class="modal-card" style="max-width: 680px; padding: 2.25rem; background: #FFFFFF !important; color: #0F172A !important; border-radius: var(--radius-xl); box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
    <div id="printable-rujukan-content">
      <!-- KOP Surat Resmi -->
      <div style="border-bottom: 2px solid #0F172A; padding-bottom: 0.75rem; margin-bottom: 1.25rem; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <div style="width: 44px; height: 44px; border-radius: 8px; background: #1E3926; color: #FFF; display: flex; align-items: center; justify-content: center; font-weight: 900;">
            <i data-lucide="cross" style="width: 24px; height: 24px;"></i>
          </div>
          <div>
            <h3 style="margin: 0; font-size: 1.1rem; color: #0F172A; font-weight: 900; letter-spacing: -0.01em;">KLINIK PRATAMA PUSDIKZI</h3>
            <p style="margin: 0; font-size: 0.75rem; font-weight: 700; color: #1E3926;">PUSAT PENDIDIKAN ZENI TNI ANGKATAN DARAT</p>
            <small style="color: #64748B; font-size: 0.7rem;">Jl. Jenderal Sudirman No. 35, Bogor Tengah • Telp: (0251) 832-1234</small>
          </div>
        </div>
        <div style="text-align: right;">
          <span style="background: #DCFCE7; color: #166534; font-size: 0.75rem; font-weight: 800; padding: 3px 8px; border-radius: 4px; font-family: monospace;">No: RUJ-20260830-0019</span>
        </div>
      </div>

      <div style="text-align: center; margin-bottom: 1.25rem;">
        <h4 style="margin: 0; font-size: 1.15rem; font-weight: 900; text-decoration: underline; color: #0F172A; text-transform: uppercase;">SURAT RUJUKAN PASIEN RAWAT JALAN</h4>
        <small style="color: #64748B; font-size: 0.75rem;">Pelayanan Rujukan Berjenjang BPJS Kesehatan & SATUSEHAT</small>
      </div>

      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 0.85rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.88rem;">
        <p style="margin: 0 0 0.35rem 0;">Kepada Yth. <strong>Dokter Spesialis Jantung & Pembuluh Darah (Kardiologi)</strong></p>
        <p style="margin: 0; color: #1E3926; font-size: 1.05rem; font-weight: 900;">RS Tk. IV 03.04.02 Salak Bogor (RST Salak)</p>
      </div>

      <div style="background: #FFFBEB; border: 1px solid #FCD34D; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.35rem;">
          <div><span>Nama Pasien:</span> <strong>Achmad Nurhadi</strong></div>
          <div><span>No. Rekam Medis:</span> <strong style="font-family: monospace;">RM-2026-0881</strong></div>
          <div><span>No. BPJS / NIK:</span> <strong style="font-family: monospace;">0001892837482 / 3175081205900001</strong></div>
          <div><span>Masa Berlaku:</span> <strong style="color: #92400E;">s/d 30 Nov 2026 (90 Hari)</strong></div>
        </div>
      </div>

      <div style="font-size: 0.88rem; line-height: 1.6; margin-bottom: 1rem;">
        <p style="margin: 0 0 0.5rem 0;"><strong>Diagnosa Rujukan (ICD-10):</strong> <span style="color: #1E3926; font-weight: 700;">Hypertensive Heart Disease without HF (I11.9)</span></p>
        <p style="margin: 0 0 0.5rem 0;"><strong>Alasan Rujukan / Permintaan Tindakan:</strong> <em>Pemeriksaan Ekokardiografi & Treadmill Test untuk evaluasi kardiomegali awal.</em></p>
        <p style="margin: 0;"><strong>Terapi Sementara Diberikan:</strong> Amlodipine 5mg tab (1x1 pagi), Captopril 25mg prn.</p>
      </div>

      <!-- Tanda Tangan Dokter -->
      <div style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid #E2E8F0; padding-top: 1rem; font-size: 0.82rem;">
        <div style="font-size: 0.75rem; color: #64748B;">
          <p style="margin: 0;">Bawa surat ini beserta KTP & Kartu BPJS.</p>
          <span style="font-family: monospace;">TTE VALID BPJS & SATUSEHAT</span>
        </div>
        <div style="text-align: center;">
          <p style="margin: 0 0 1.5rem 0; font-size: 0.78rem;">Bogor, 30 Agustus 2026<br/>Dokter Pengirim / Perujuk,</p>
          <strong style="color: #0F172A; display: block; border-bottom: 1px solid #0F172A;">dr. Agus Susanto, Sp.PD</strong>
          <small style="color: #64748B; font-size: 0.72rem;">SIP: 446.1/082/SIP-D/2024</small>
        </div>
      </div>
    </div>

    <div class="flex gap-2" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
      <button class="btn btn-primary btn-sm flex items-center justify-center gap-1" style="flex: 1;" onclick="window.print()">
        <i data-lucide="printer"></i> Cetak Surat Rujukan (Print / PDF)
      </button>
      <button class="btn btn-outline btn-sm" style="flex: 1;" onclick="document.getElementById('rujukan-modal-overlay').classList.remove('open')">
        Tutup
      </button>
    </div>
  </div>
</div>
