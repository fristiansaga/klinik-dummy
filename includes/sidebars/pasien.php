<!-- Sidebar Pasien & Health Passport (HexaBox Layout) -->
<aside class="sidebar" id="dashboard-sidebar">
  <?php require __DIR__ . '/brand-header.php'; ?>

  <div class="sidebar-inner-content">
    <div class="user-badge flex items-center gap-3">
      <div class="user-avatar" style="background: var(--primary); color: #FFF;">
        AN
      </div>
      <div>
        <h4>Achmad Nurhadi</h4>
        <span class="badge badge-primary">Pasien Umum / BPJS</span>
      </div>
    </div>

    <div class="sidebar-category">LAYANAN MANDIRI PASIEN</div>

    <nav class="sidebar-menu">
      <button class="sidebar-menu-item active" onclick="showTab('passport', this)">
        <i data-lucide="activity"></i> <span>Buku Kesehatan Digital</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('booking', this)">
        <i data-lucide="calendar-plus"></i> <span>Pendaftaran Periksa</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('antrean', this)">
        <i data-lucide="clock"></i> <span>Pantauan Antrean Berjalan</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('resep', this)">
        <i data-lucide="pill"></i> <span>Resep Obat Pasien</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('riwayat', this)">
        <i data-lucide="file-text"></i> <span>Catatan Riwayat Medis</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('rujukan', this)">
        <i data-lucide="send"></i> <span>Surat Rujukan Faskes</span>
      </button>
    </nav>
  </div>

  <div class="sidebar-footer-box">
    <div class="card" style="padding: 0.85rem; background: var(--bg-subtle); border: 1px solid var(--border-color); color: var(--text-dark);">
      <div class="flex items-center gap-2" style="margin-bottom: 0.25rem;">
        <i data-lucide="shield-check" style="width: 16px; color: var(--primary);"></i>
        <strong style="font-size: 0.85rem;">SATUSEHAT Terhubung</strong>
      </div>
      <p style="font-size: 0.72rem; margin: 0; color: var(--text-muted);">Nomor IHS: P-8829103991 terverifikasi</p>
    </div>
  </div>
</aside>
