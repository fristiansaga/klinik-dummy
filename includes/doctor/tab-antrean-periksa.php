<!-- Tab 1: Antrean Pasien Poli -->
<div id="tab-antrean_periksa" class="tab-pane">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Daftar Antrean Pasien Poliklinik</h2>
      <p style="color: var(--text-light);">Poli Penyakit Dalam • Ruang Periksa 2</p>
    </div>
    <button class="btn btn-primary btn-sm flex items-center gap-1" onclick="showTab('ruang_periksa')">
      <i data-lucide="play"></i> Lanjutkan Periksa (A-004)
    </button>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-antrean-pasien.php'; ?>
  </div>
</div>
