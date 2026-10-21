<!-- Sidebar Kasir & Keuangan (HexaBox Layout) -->
<aside class="sidebar" id="dashboard-sidebar">
  <?php require __DIR__ . '/brand-header.php'; ?>

  <div class="sidebar-inner-content">
    <div class="user-badge flex items-center gap-3">
      <div class="user-avatar" style="background: var(--accent); color: #FFF;">
        MY
      </div>
      <div>
        <h4>Serka M. Yusuf</h4>
        <span class="badge badge-orange">Kasir & Keuangan</span>
      </div>
    </div>

    <div class="sidebar-category">KASIR & TRANSAKSI</div>

    <nav class="sidebar-menu">
      <button class="sidebar-menu-item active" onclick="showTab('beranda_kasir', this)">
        <i data-lucide="layout-dashboard"></i> <span>Ringkasan Kasir</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('antrean_bayar', this)">
        <i data-lucide="receipt"></i> <span>Tagihan & Pembayaran</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('rekap_kas', this)">
        <i data-lucide="bar-chart-3"></i> <span>Laporan Kas Harian</span>
      </button>
    </nav>
  </div>

  <div class="sidebar-footer-box">
    <div class="card" style="padding: 0.85rem; background: var(--bg-subtle); border: 1px solid var(--border-color); color: var(--text-dark);">
      <div class="flex items-center gap-2" style="margin-bottom: 0.25rem;">
        <i data-lucide="wallet" style="width: 16px; color: var(--highlight-orange);"></i>
        <strong style="font-size: 0.85rem;">Kasir Buka: 07.30 - 21.00 WIB</strong>
      </div>
      <p style="font-size: 0.72rem; margin: 0; color: var(--text-muted);">Mendukung BPJS Kesehatan & QRIS</p>
    </div>
  </div>
</aside>
