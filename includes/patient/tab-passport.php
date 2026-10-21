<!-- Tab 1: Health Passport -->
<div id="tab-passport" class="tab-pane">
  <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Buku Kesehatan Digital Pasien</h2>
      <p style="color: var(--text-light);">Identitas Pasien Terpadu & Ringkasan Rekam Kesehatan Digital.</p>
    </div>
    <div class="flex gap-2">
      <button class="btn btn-sm flex items-center gap-1" style="background: #075E54; color: #FFF; border: none; font-weight: 600;" onclick="openWaSimulator('antrean')">
        <i data-lucide="message-circle"></i> Notifikasi WhatsApp
      </button>
      <button class="btn btn-outline btn-sm flex items-center gap-2" onclick="window.print()">
        <i data-lucide="printer"></i> Cetak Kartu
      </button>
    </div>
  </div>

  <!-- Sliced Partial: Kartu Pasien Passport -->
  <?php require __DIR__ . '/kartu-passport.php'; ?>

  <!-- Sliced Partial: Hasil Lab POCT & Surat Dokter -->
  <?php require __DIR__ . '/tabel-lab-surat.php'; ?>
</div>
