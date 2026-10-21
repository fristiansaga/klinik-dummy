<!-- Tab 5: Riwayat Rekam Medis -->
<div id="tab-riwayat" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center flex-wrap gap-4" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Riwayat Rekam Medis Pasien</h2>
      <p style="color: var(--text-light);">Histori kunjungan klinis, diagnosa ICD-10, tanda vital, dan terapi resep terenkripsi.</p>
    </div>
    <button class="btn btn-primary btn-sm flex items-center gap-1" onclick="openRiwayatModalPasien()">
      <i data-lucide="printer"></i> Cetak Lembar Riwayat Medis (PDF)
    </button>
  </div>
  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-riwayat-medis.php'; ?>
  </div>
</div>
