<!-- Tab 3: Generator Surat Keterangan Medis -->
<div id="tab-surat_medis" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Penerbitan Surat Keterangan Medis</h2>
      <p style="color: var(--text-light);">Surat keterangan sakit, SKBS, dan surat rujukan FKTP Pusdikzi Kodiklatad.</p>
    </div>
    <button class="btn btn-outline btn-sm" onclick="showTab('ruang_periksa')">
      <i data-lucide="arrow-left"></i> Kembali ke Pemeriksaan SOAP
    </button>
  </div>

  <div class="card" style="max-width: 780px; padding: 2rem;">
    <?php require __DIR__ . '/form-surat-medis.php'; ?>
  </div>
</div>
