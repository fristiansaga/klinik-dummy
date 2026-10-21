<!-- Rapid Lab Results & Medical Certificate Cards -->
<div class="grid grid-cols-2 gap-4" style="margin-top: 1.5rem;">
  <!-- Hasil Lab Cepat -->
  <div class="card" style="padding: 1.5rem; border-top: 4px solid var(--primary);">
    <div class="flex justify-between items-center" style="margin-bottom: 1rem;">
      <h4 style="color: var(--primary); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
        <i data-lucide="flask-conical"></i> Hasil Lab Cepat (POCT Terakhir)
      </h4>
      <span class="badge badge-success">30 Agu 2026</span>
    </div>
    <div class="grid grid-cols-3 gap-2" style="text-align: center;">
      <div style="padding: 0.75rem 0.5rem; background: var(--bg-main); border-radius: var(--radius-md);">
        <small style="color: var(--text-muted); font-size: 0.75rem;">Gula Darah (GDS)</small>
        <h4 style="color: var(--success); margin: 0.2rem 0; font-size: 1.15rem;">110</h4>
        <small style="font-size: 0.7rem; color: var(--success);">mg/dL (Normal)</small>
      </div>
      <div style="padding: 0.75rem 0.5rem; background: var(--bg-main); border-radius: var(--radius-md);">
        <small style="color: var(--text-muted); font-size: 0.75rem;">Kolesterol</small>
        <h4 style="color: var(--success); margin: 0.2rem 0; font-size: 1.15rem;">175</h4>
        <small style="font-size: 0.7rem; color: var(--success);">mg/dL (Normal)</small>
      </div>
      <div style="padding: 0.75rem 0.5rem; background: var(--bg-main); border-radius: var(--radius-md);">
        <small style="color: var(--text-muted); font-size: 0.75rem;">Asam Urat</small>
        <h4 style="color: var(--success); margin: 0.2rem 0; font-size: 1.15rem;">5.4</h4>
        <small style="font-size: 0.7rem; color: var(--success);">mg/dL (Normal)</small>
      </div>
    </div>
  </div>

  <!-- Surat Keterangan Dokter Saya -->
  <div class="card" style="padding: 1.5rem; border-top: 4px solid var(--accent);">
    <div class="flex justify-between items-center" style="margin-bottom: 1rem;">
      <h4 style="color: var(--primary); display: flex; align-items: center; gap: 0.5rem; margin: 0;">
        <i data-lucide="file-text"></i> Surat Medis & Izin Dokter
      </h4>
      <span class="badge badge-warning">Tersedia</span>
    </div>
    <div style="padding: 0.85rem; background: var(--bg-main); border-radius: var(--radius-md); margin-bottom: 0.75rem;">
      <div class="flex justify-between items-center">
        <div>
          <strong style="font-size: 0.9rem;">Surat Keterangan Sakit (2 Hari)</strong>
          <p style="margin: 0.2rem 0 0; font-size: 0.75rem; color: var(--text-muted);">dr. Agus Susanto, Sp.PD • 30 Agu 2026</p>
        </div>
        <button class="btn btn-outline btn-sm flex items-center gap-1" onclick="window.print()">
          <i data-lucide="printer" style="width: 14px;"></i> Cetak
        </button>
      </div>
    </div>
    <small style="color: var(--text-muted); font-size: 0.75rem;">*Diverifikasi resmi dengan tanda tangan elektronik SATUSEHAT Kemenkes.</small>
  </div>
</div>
