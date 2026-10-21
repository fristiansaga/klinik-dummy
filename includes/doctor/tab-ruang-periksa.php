<!-- Tab 2: Ruang Periksa SOAP & POCT Lab -->
<div id="tab-ruang_periksa" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Pemeriksaan Rekam Medis Elektronik (SOAP)</h2>
      <p style="color: var(--text-light);">Standar RME Permenkes No. 24/2022 terintegrasi SATUSEHAT Kemenkes RI.</p>
    </div>
    <button class="btn btn-outline btn-sm" onclick="showTab('antrean_periksa')">
      <i data-lucide="arrow-left"></i> Kembali ke Antrean
    </button>
  </div>

  <div class="card" style="padding: 2rem;">
    <?php require __DIR__ . '/form-soap-vital.php'; ?>
  </div>
</div>
