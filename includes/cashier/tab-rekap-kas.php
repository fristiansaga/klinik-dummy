<!-- Tab 3: Rekapitulasi Kas Harian -->
<div id="tab-rekap_kas" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Rekapitulasi Kas & Pendapatan Harian</h2>
      <p style="color: var(--text-light);">Laporan arus kas dan rincian transaksi billing klinik per tanggal.</p>
    </div>
    <button class="btn btn-outline btn-sm flex items-center gap-1" onclick="window.print()">
      <i data-lucide="download"></i> Cetak Laporan Kas (PDF)
    </button>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-rekap-kas.php'; ?>
  </div>
</div>
