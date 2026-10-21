<!-- Sidebar Dokter (HexaBox Layout) -->
<aside class="sidebar" id="dashboard-sidebar">
  <?php require __DIR__ . '/brand-header.php'; ?>

  <div class="sidebar-inner-content">
    <div class="user-badge flex items-center gap-3">
      <div class="user-avatar" style="background: var(--warning); color: #FFF;">
        DA
      </div>
      <div>
        <h4>dr. Agus Susanto, Sp.PD</h4>
        <span class="badge badge-warning">Dokter Spesialis</span>
      </div>
    </div>

    <div class="sidebar-category">PELAYANAN POLIKLINIK</div>

    <nav class="sidebar-menu">
      <button class="sidebar-menu-item active" onclick="showTab('antrean_periksa', this)">
        <i data-lucide="users"></i> <span>Daftar Antrean Pasien</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('ruang_periksa', this)">
        <i data-lucide="stethoscope"></i> <span>Pemeriksaan Medis (SOAP)</span>
      </button>
      <button class="sidebar-menu-item" onclick="showTab('surat_medis', this)">
        <i data-lucide="file-text"></i> <span>Surat Keterangan Dokter</span>
      </button>
    </nav>
  </div>

  <div class="sidebar-footer-box">
    <div class="card" style="padding: 0.85rem; background: var(--bg-subtle); border: 1px solid var(--border-color); color: var(--text-dark);">
      <div class="flex items-center gap-2" style="margin-bottom: 0.25rem;">
        <i data-lucide="activity" style="width: 16px; color: var(--warning);"></i>
        <strong style="font-size: 0.85rem;">Ruang Periksa 2 Aktif</strong>
      </div>
      <p style="font-size: 0.72rem; margin: 0; color: var(--text-muted);">Poli Penyakit Dalam (08.00 - 13.00 WIB)</p>
    </div>
  </div>
</aside>
