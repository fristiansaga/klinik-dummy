<!-- Tab 2: Antrean E-Resep Masuk -->
<div id="tab-resep_masuk" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Antrean Resep Elektronik Masuk</h2>
      <p style="color: var(--text-light);">Resep elektronik langsung dari ruang periksa dokter.</p>
    </div>
    <button class="btn btn-outline btn-sm flex items-center gap-1" onclick="showToast('Antrean resep diperbarui.', 'success')">
      <i data-lucide="refresh-cw"></i> Perbarui Antrean
    </button>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-resep-masuk.php'; ?>
  </div>
</div>
