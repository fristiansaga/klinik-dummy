<!-- Tab 6: Surat Rujukan Medis Pasien -->
<div id="tab-rujukan" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center flex-wrap gap-4" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Surat Rujukan Medis FKTP</h2>
      <p style="color: var(--text-light);">Surat pengantar rujukan berjenjang BPJS Kesehatan & SATUSEHAT ke Rumah Sakit Lanjutan.</p>
    </div>
    <button class="btn btn-primary btn-sm flex items-center gap-1" onclick="openRujukanModalPasien()">
      <i data-lucide="printer"></i> Cetak Lembar Rujukan
    </button>
  </div>

  <div class="card" style="padding: 2rem; border-left: 6px solid var(--accent); margin-bottom: 1.5rem;">
    <div class="flex justify-between items-start flex-wrap gap-3" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
      <div>
        <span class="badge badge-warning" style="margin-bottom: 0.5rem; display: inline-block;">STATUS: RUJUKAN AKTIF (90 HARI)</span>
        <h3 style="margin: 0.2rem 0; font-size: 1.35rem; color: var(--text-dark);">RS Tk. IV 03.04.02 Salak Bogor (RST Salak)</h3>
        <p style="margin: 0; color: var(--primary); font-weight: 700;">Tujuan Poli: Spesialis Jantung & Pembuluh Darah (Kardiologi)</p>
      </div>
      <div style="text-align: right;">
        <span class="badge badge-primary" style="font-family: monospace; font-size: 0.85rem;">No. RUJ-20260830-0019</span>
        <p style="font-size: 0.75rem; color: var(--text-muted); margin: 0.35rem 0 0;">Berlaku s/d: <strong>30 Nov 2026</strong></p>
      </div>
    </div>

    <div class="grid grid-cols-2 gap-4" style="font-size: 0.88rem; margin-bottom: 1rem;">
      <div style="background: var(--bg-main); padding: 1rem; border-radius: 8px;">
        <span style="color: var(--text-muted); font-size: 0.75rem; display: block; margin-bottom: 0.2rem;">Diagnosa Rujukan (ICD-10):</span>
        <strong style="color: var(--primary); font-size: 0.95rem;">Hypertensive Heart Disease (I11.9)</strong>
      </div>
      <div style="background: var(--bg-main); padding: 1rem; border-radius: 8px;">
        <span style="color: var(--text-muted); font-size: 0.75rem; display: block; margin-bottom: 0.2rem;">Alasan Rujukan / Permintaan Tindakan:</span>
        <p style="margin: 0; font-style: italic;">Pemeriksaan Ekokardiografi & Treadmill Test untuk evaluasi kardiomegali awal.</p>
      </div>
    </div>

    <div style="display: flex; align-items: center; justify-content: space-between; background: #DCFCE7; padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.82rem; color: #166534;">
      <span>✓ Terverifikasi secara elektronik oleh <strong>dr. Agus Susanto, Sp.PD</strong> (SIP: 446.1/082/SIP-D/2024)</span>
      <button class="btn btn-primary btn-sm" onclick="openRujukanModalPasien()">
        <i data-lucide="printer" style="width: 14px;"></i> Lihat Dokumen & Cetak
      </button>
    </div>
  </div>
</div>
