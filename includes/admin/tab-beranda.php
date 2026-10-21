<!-- Tab 1: Executive KPI Analytics & Charts -->
<div id="tab-beranda" class="tab-pane">
  <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Pusat Kendali Eksekutif & Analisis Operasional</h2>
      <p style="color: var(--text-light);">Ringkasan performa pelayanan medis, capaian indikator mutu, dan pemantauan pendapatan klinik.</p>
    </div>
    <button class="btn btn-primary btn-sm flex items-center gap-2" onclick="window.print()">
      <i data-lucide="printer"></i> Cetak Laporan Eksekutif
    </button>
  </div>

  <?php require __DIR__ . '/kpi-charts.php'; ?>
</div>
