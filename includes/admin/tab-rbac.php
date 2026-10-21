<!-- Tab 2: Hak Akses & User RBAC -->
<div id="tab-rbac" class="tab-pane" style="display: none;">
  <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
    <div>
      <h2 style="font-size: 1.75rem; color: var(--primary);">Pengaturan Pengguna & Hak Akses (RBAC)</h2>
      <p style="color: var(--text-light);">Pengaturan hak akses staf medis, dokter, perawat, apoteker, dan kasir.</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="showToast('Form penambahan pengguna dibuka.', 'success')">
      <i data-lucide="user-plus"></i> Tambah Pengguna
    </button>
  </div>

  <div class="card" style="padding: 1.5rem;">
    <?php require __DIR__ . '/tabel-rbac-users.php'; ?>
  </div>
</div>
