<!-- Command Palette Modal (Ctrl+K) -->
<div class="modal-overlay" id="cmd-palette-modal">
  <div class="modal-card cmd-palette">
    <div class="cmd-input-wrapper">
      <i data-lucide="search" style="color: var(--text-muted);"></i>
      <input type="text" id="cmd-input" class="cmd-input" placeholder="Cari halaman modul (Pasien, Dokter, Apotek, Kasir, Admin, TV)..." />
    </div>
    <div class="cmd-results">
      <a href="pasien.php" class="cmd-item" style="text-decoration: none;">
        <span><strong>Buka Portal Pasien</strong> (Health Passport & Booking)</span>
        <span class="badge badge-primary">Pasien</span>
      </a>
      <a href="dokter.php" class="cmd-item" style="text-decoration: none;">
        <span><strong>Buka Clinical Workspace</strong> (Dokter & EMR SOAP)</span>
        <span class="badge badge-warning">Dokter</span>
      </a>
      <a href="apotek.php" class="cmd-item" style="text-decoration: none;">
        <span><strong>Buka Instalasi Farmasi</strong> (E-Resep & Stok Obat)</span>
        <span class="badge badge-success">Apotek</span>
      </a>
      <a href="kasir.php" class="cmd-item" style="text-decoration: none;">
        <span><strong>Buka Kasir & Billing</strong> (Invoice & Pembayaran)</span>
        <span class="badge badge-orange">Kasir</span>
      </a>
      <a href="admin.php" class="cmd-item" style="text-decoration: none;">
        <span><strong>Buka Admin Command Center</strong> (Analytics & Master)</span>
        <span class="badge badge-danger">Admin</span>
      </a>
      <a href="antrian-tv.php" target="_blank" class="cmd-item" style="text-decoration: none;">
        <span><strong>Buka Layar TV Antrean</strong> (Fullscreen Display TV)</span>
        <span class="badge" style="background: #E0F2FE; color: #0284c7;">TV</span>
      </a>
    </div>
  </div>
</div>
