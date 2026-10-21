<!-- Tab 2: Antrean Billing Pasien -->
<div id="tab-antrean_bayar" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Daftar Antrean Pembayaran Pasien</h2>
      <p style="color: var(--text-light);">Daftar tagihan pasien yang telah selesai dari ruang periksa dokter dan farmasi.</p>
    </div>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-antrean-bayar.php'; ?>
  </div>
</div>
