<!-- Tab 3: Manajemen Stok Obat -->
<div id="tab-stok_obat" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Inventaris & Data Induk Obat</h2>
      <p style="color: var(--text-light);">Monitoring ketersediaan obat, batas minimum stok, dan harga satuan.</p>
    </div>
    <div class="flex gap-2">
      <button class="btn btn-outline btn-sm flex items-center gap-1" onclick="showTab('stock_opname')">
        <i data-lucide="clipboard-check"></i> Pemeriksaan Stok
      </button>
      <button class="btn btn-primary btn-sm flex items-center gap-1" onclick="showTab('tambah_obat')">
        <i data-lucide="plus"></i> Tambah Data Obat
      </button>
    </div>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-stok-obat.php'; ?>
  </div>
</div>
