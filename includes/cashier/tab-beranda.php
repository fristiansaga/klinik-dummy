<!-- Tab 1: Dashboard Kasir -->
<div id="tab-beranda_kasir" class="tab-pane">
  <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Kasir & Pembayaran Pasien</h2>
      <p style="color: var(--text-light);">Kelola pembayaran tunai, QRIS, dan kuitansi klaim BPJS Kesehatan.</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="showTab('antrean_bayar')">
      <i data-lucide="receipt"></i> Lihat Antrean Tagihan
    </button>
  </div>

  <div class="card" style="padding: 1.5rem; margin-bottom: 2rem; border-left: 6px solid var(--accent);">
    <div class="flex justify-between items-center">
      <div>
        <span class="badge badge-orange">TAGIHAN SIAP DIPROSES</span>
        <h3 style="margin: 0.35rem 0; font-size: 1.3rem;">B-008: Bapak Hendra Kusuma (Umum)</h3>
        <p style="color: var(--text-light); margin: 0;">Poli Gigi (Penambalan Gigi Komposit + Resep Analgesik) • Total: <strong>Rp 275.000</strong></p>
      </div>
      <button class="btn btn-primary btn-sm" onclick="openReceiptModal('Hendra Kusuma', 'RM-2026-0551', 'Umum Mandiri', 275000)">
        <i data-lucide="credit-card"></i> Proses Pembayaran
      </button>
    </div>
  </div>
</div>
