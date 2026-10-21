<!-- Tab 4: Stock Opname & Batch FEFO Tracker -->
<div id="tab-stock_opname" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center flex-wrap gap-4" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Pemeriksaan Stok Fisik & Pelacakan Batch FEFO</h2>
      <p style="color: var(--text-light);">Pantau tanggal kedaluwarsa, nomor batch, sisa umur simpan obat, dan penyesuaian fisik.</p>
    </div>
    <div class="flex gap-2">
      <button class="btn btn-outline btn-sm flex items-center gap-1" onclick="window.print()">
        <i data-lucide="printer"></i> Cetak Berita Acara
      </button>
      <button id="btn-toggle-global-opname" class="btn btn-outline btn-sm flex items-center gap-1" onclick="toggleGlobalEditOpname(this)">
        <i data-lucide="edit-3"></i> Edit Penyesuaian Fisik
      </button>
    </div>
  </div>

  <!-- Early Warning Cards -->
  <div class="grid grid-cols-3 gap-4" style="margin-bottom: 1.5rem;">
    <div class="card" style="padding: 1.25rem; background: #FEE2E2; border-left: 5px solid var(--danger); color: #991B1B;">
      <div class="flex justify-between items-center">
        <div>
          <span style="font-size: 0.8rem; font-weight: 700;">🔴 KRITIS (&lt; 30 HARI / EXPIRED)</span>
          <h3 style="font-size: 1.6rem; margin: 0.25rem 0;">1 Batch</h3>
          <small>Wajib Karantina / Retur Distributor</small>
        </div>
        <i data-lucide="alert-octagon" style="width: 32px; height: 32px; opacity: 0.8;"></i>
      </div>
    </div>
    <div class="card" style="padding: 1.25rem; background: #FEF3C7; border-left: 5px solid var(--warning); color: #92400E;">
      <div class="flex justify-between items-center">
        <div>
          <span style="font-size: 0.8rem; font-weight: 700;">🟡 WASPADA FEFO (&lt; 90 HARI)</span>
          <h3 style="font-size: 1.6rem; margin: 0.25rem 0;">2 Batch</h3>
          <small>Prioritas Utama Dikeluarkan Pertama</small>
        </div>
        <i data-lucide="alert-triangle" style="width: 32px; height: 32px; opacity: 0.8;"></i>
      </div>
    </div>
    <div class="card" style="padding: 1.25rem; background: #DCFCE7; border-left: 5px solid var(--success); color: #166534;">
      <div class="flex justify-between items-center">
        <div>
          <span style="font-size: 0.8rem; font-weight: 700;">🟢 STOK AMAN (&gt; 6 BULAN)</span>
          <h3 style="font-size: 1.6rem; margin: 0.25rem 0;">18 Batch</h3>
          <small>Kondisi Penyimpanan Baik</small>
        </div>
        <i data-lucide="check-circle" style="width: 32px; height: 32px; opacity: 0.8;"></i>
      </div>
    </div>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <div class="table-responsive" style="width: 100%; overflow-x: auto;">
      <?php require __DIR__ . '/tabel-stock-opname.php'; ?>
    </div>
  </div>
</div>
