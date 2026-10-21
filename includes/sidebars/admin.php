<!-- Sidebar Admin & Executive (HexaBox Layout) -->
<aside class="sidebar" id="dashboard-sidebar">
  <?php require __DIR__ . '/brand-header.php'; ?>

  <div class="sidebar-inner-content">
    <div class="user-badge flex items-center gap-3">
      <div class="user-avatar" style="background: var(--danger); color: #FFF;">
        AD
      </div>
      <div>
        <h4>Administrator</h4>
        <span class="badge badge-danger">Super Admin IT</span>
      </div>
    </div>

    <div class="sidebar-category">MENU UTAMA</div>

    <nav class="sidebar-menu">
      <button class="sidebar-menu-item active" onclick="showTab('beranda', this)">
        <i data-lucide="gauge"></i> <span>Analisis Kinerja Eksekutif</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('rbac', this)">
        <i data-lucide="shield-check"></i> <span>Pengguna & Hak Akses</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('master_data', this)">
        <i data-lucide="database"></i> <span>Data Induk Klinik</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('integrasi', this)">
        <i data-lucide="wifi"></i> <span>Integrasi SATUSEHAT</span>
      </button>
    </nav>
  </div>

  <div class="sidebar-footer-box">
    <div class="card" style="padding: 0.85rem; background: var(--bg-subtle); border: 1px solid var(--border-color); color: var(--text-dark);">
      <div class="flex items-center gap-2" style="margin-bottom: 0.25rem;">
        <span style="width: 8px; height: 8px; border-radius: 50%; background: #16A34A; display: inline-block;"></span>
        <strong style="font-size: 0.85rem;">Kondisi Sistem: 99,98%</strong>
      </div>
      <p style="font-size: 0.72rem; margin: 0; color: var(--text-muted);">Versi Sistem Klinik PUSDIKZI 2026.5</p>
    </div>
  </div>
</aside>
