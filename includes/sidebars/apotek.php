<!-- Sidebar Apotek & Farmasi (HexaBox Layout) -->
<aside class="sidebar" id="dashboard-sidebar">
  <?php require __DIR__ . '/brand-header.php'; ?>

  <div class="sidebar-inner-content">
    <div class="user-badge flex items-center gap-3">
      <div class="user-avatar" style="background: var(--success); color: #FFF;">
        NH
      </div>
      <div>
        <h4>apt. Nurul Hidayah, S.Farm</h4>
        <span class="badge badge-success">Kepala Farmasi</span>
      </div>
    </div>

    <div class="sidebar-category">LAYANAN FARMASI</div>

    <nav class="sidebar-menu">
      <button class="sidebar-menu-item active" onclick="showTab('beranda', this)">
        <i data-lucide="layout-dashboard"></i> <span>Ringkasan Farmasi</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('resep_masuk', this)">
        <i data-lucide="file-text"></i> <span>Antrean Resep Elektronik</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('stok_obat', this)">
        <i data-lucide="package"></i> <span>Daftar & Stok Obat</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('stock_opname', this)">
        <i data-lucide="clipboard-check"></i> <span>Pemeriksaan Stok (FEFO)</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('tambah_obat', this)">
        <i data-lucide="plus-circle"></i> <span>Tambah Data Obat</span>
      </button>
    </nav>
  </div>

  <div class="sidebar-footer-box">
    <div class="card" style="padding: 0.85rem; background: var(--bg-subtle); border: 1px solid var(--border-color); color: var(--text-dark);">
      <div class="flex items-center gap-2" style="margin-bottom: 0.25rem;">
        <i data-lucide="check-circle" style="width: 16px; color: var(--success);"></i>
        <strong style="font-size: 0.85rem;">Pelayanan Farmasi Buka</strong>
      </div>
      <p style="font-size: 0.72rem; margin: 0; color: var(--text-muted);">Metode FEFO dan pencatatan aktif</p>
    </div>
  </div>
</aside>
