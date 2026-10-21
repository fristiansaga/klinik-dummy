<!-- Tab 1: Dashboard Farmasi -->
<div id="tab-beranda" class="tab-pane">
  <div class="flex items-center justify-between" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Ringkasan Instalasi Farmasi</h2>
      <p style="color: var(--text-light);">Kelola dispensing resep digital, peracikan obat, dan monitoring persediaan medis.</p>
    </div>
    <div class="flex gap-2">
      <button class="btn btn-outline btn-sm flex items-center gap-1" onclick="showTab('stock_opname')">
        <i data-lucide="clipboard-check"></i> Pemeriksaan Stok
      </button>
      <button class="btn btn-primary btn-sm flex items-center gap-2" onclick="showTab('resep_masuk')">
        <i data-lucide="clipboard-list"></i> Lihat Resep Masuk
      </button>
    </div>
  </div>

  <!-- Stats Grid -->
  <div class="grid grid-cols-4 gap-4" style="margin-bottom: 2rem;">
    <div class="card flex items-center gap-4" style="padding: 1.25rem;">
      <div style="width: 48px; height: 48px; border-radius: 12px; background: #DCFCE7; color: var(--success); display: flex; align-items: center; justify-content: center;">
        <i data-lucide="file-check" style="width: 24px; height: 24px;"></i>
      </div>
      <div>
        <span style="font-size: 0.8rem; color: var(--text-light);">Resep Selesai Hari Ini</span>
        <h3 style="font-size: 1.5rem; color: var(--success); margin: 0;">24 Resep</h3>
      </div>
    </div>
    <div class="card flex items-center gap-4" style="padding: 1.25rem;">
      <div style="width: 48px; height: 48px; border-radius: 12px; background: #FEF3C7; color: var(--warning); display: flex; align-items: center; justify-content: center;">
        <i data-lucide="clock" style="width: 24px; height: 24px;"></i>
      </div>
      <div>
        <span style="font-size: 0.8rem; color: var(--text-light);">Menunggu Diracik</span>
        <h3 style="font-size: 1.5rem; color: var(--warning); margin: 0;">3 Resep</h3>
      </div>
    </div>
    <div class="card flex items-center gap-4" style="padding: 1.25rem;">
      <div style="width: 48px; height: 48px; border-radius: 12px; background: #FEE2E2; color: var(--danger); display: flex; align-items: center; justify-content: center;">
        <i data-lucide="alert-triangle" style="width: 24px; height: 24px;"></i>
      </div>
      <div>
        <span style="font-size: 0.8rem; color: var(--text-light);">Stok Obat Kritis</span>
        <h3 style="font-size: 1.5rem; color: var(--danger); margin: 0;">2 Item</h3>
      </div>
    </div>
    <div class="card flex items-center gap-4" style="padding: 1.25rem;">
      <div style="width: 48px; height: 48px; border-radius: 12px; background: #FFEDD5; color: var(--accent); display: flex; align-items: center; justify-content: center;">
        <i data-lucide="calendar" style="width: 24px; height: 24px;"></i>
      </div>
      <div>
        <span style="font-size: 0.8rem; color: var(--text-light);">Mendekati Expired</span>
        <h3 style="font-size: 1.5rem; color: var(--accent); margin: 0;">3 Batch</h3>
      </div>
    </div>
  </div>
</div>
