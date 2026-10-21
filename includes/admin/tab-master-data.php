<!-- Tab 3: Master Data Tarif Layanan -->
<div id="tab-master_data" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Data Induk Tarif & Layanan Klinik</h2>
      <p style="color: var(--text-light);">Konfigurasi tarif tindakan medis umum dan penjamin BPJS Kesehatan.</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="showToast('Form penambahan tarif dibuka.', 'success')">
      <i data-lucide="plus"></i> Tambah Tarif
    </button>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-master-tarif.php'; ?>
  </div>
</div>
