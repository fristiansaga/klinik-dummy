<!-- Login Portal Form & Role Switcher -->
<div class="card" style="max-width: 900px; width: 100%; padding: 2.5rem; box-shadow: var(--shadow-lg); border-radius: var(--radius-xl);">
  <div style="text-align: center; margin-bottom: 2rem;">
    <span class="badge badge-primary" style="margin-bottom: 0.5rem; font-weight: 800; letter-spacing: 0.04em;">PORTAL AUTENTIKASI STAF MEDIS & PASIEN</span>
    <h2 style="font-size: 2.1rem; color: var(--primary); font-weight: 800;">Sistem Informasi SIMKLINIK PUSDIKZI</h2>
    <p style="color: var(--text-muted); max-width: 550px; margin: 0.5rem auto 0; font-size: 1rem;">
      Silakan pilih hak akses role untuk masuk ke ruang kerja klinis masing-masing.
    </p>
  </div>

  <!-- Quick Role Access Cards -->
  <div style="margin-bottom: 2rem;">
    <h4 style="margin-bottom: 1rem; color: var(--text-dark); font-size: 1rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
      <i data-lucide="shield-check" style="color: var(--primary); width: 18px;"></i> Akses Cepat Berdasarkan Role Akun:
    </h4>

    <div class="grid grid-cols-3 gap-3">
      <a href="pasien.php" class="card card-interactive" style="padding: 1.25rem; text-decoration: none; border-left: 4px solid var(--primary);">
        <div class="flex items-center gap-3">
          <div style="width: 38px; height: 38px; border-radius: 10px; background: var(--primary-bg); color: var(--primary); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="user" style="width: 20px;"></i>
          </div>
          <div>
            <h5 style="margin: 0; color: var(--text-main); font-size: 0.95rem;">Pasien & Passport</h5>
            <small style="color: var(--text-muted);">Achmad Nurhadi</small>
          </div>
        </div>
      </a>

      <a href="dokter.php" class="card card-interactive" style="padding: 1.25rem; text-decoration: none; border-left: 4px solid var(--warning);">
        <div class="flex items-center gap-3">
          <div style="width: 38px; height: 38px; border-radius: 10px; background: #FEF3C7; color: var(--warning); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="stethoscope" style="width: 20px;"></i>
          </div>
          <div>
            <h5 style="margin: 0; color: var(--text-main); font-size: 0.95rem;">Dokter Pemeriksa</h5>
            <small style="color: var(--text-muted);">dr. Agus Susanto, Sp.PD</small>
          </div>
        </div>
      </a>

      <a href="apotek.php" class="card card-interactive" style="padding: 1.25rem; text-decoration: none; border-left: 4px solid var(--success);">
        <div class="flex items-center gap-3">
          <div style="width: 38px; height: 38px; border-radius: 10px; background: #DCFCE7; color: var(--success); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="pill" style="width: 20px;"></i>
          </div>
          <div>
            <h5 style="margin: 0; color: var(--text-main); font-size: 0.95rem;">Apotek & Farmasi</h5>
            <small style="color: var(--text-muted);">apt. Nurul Hidayah</small>
          </div>
        </div>
      </a>

      <a href="kasir.php" class="card card-interactive" style="padding: 1.25rem; text-decoration: none; border-left: 4px solid var(--accent);">
        <div class="flex items-center gap-3">
          <div style="width: 38px; height: 38px; border-radius: 10px; background: #FFEDD5; color: var(--accent); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="credit-card" style="width: 20px;"></i>
          </div>
          <div>
            <h5 style="margin: 0; color: var(--text-main); font-size: 0.95rem;">Kasir & Billing</h5>
            <small style="color: var(--text-muted);">Serka M. Yusuf</small>
          </div>
        </div>
      </a>

      <a href="admin.php" class="card card-interactive" style="padding: 1.25rem; text-decoration: none; border-left: 4px solid var(--danger);">
        <div class="flex items-center gap-3">
          <div style="width: 38px; height: 38px; border-radius: 10px; background: #FEE2E2; color: var(--danger); display: flex; align-items: center; justify-content: center;">
            <i data-lucide="shield" style="width: 20px;"></i>
          </div>
          <div>
            <h5 style="margin: 0; color: var(--text-main); font-size: 0.95rem;">Admin IT & RBAC</h5>
            <small style="color: var(--text-muted);">Super Admin</small>
          </div>
        </div>
      </a>

      <a href="antrian-tv.php" target="_blank" class="card card-interactive" style="padding: 1.25rem; text-decoration: none; border-left: 4px solid #38bdf8;">
        <div class="flex items-center gap-3">
          <div style="width: 38px; height: 38px; border-radius: 10px; background: #E0F2FE; color: #0284c7; display: flex; align-items: center; justify-content: center;">
            <i data-lucide="tv" style="width: 20px;"></i>
          </div>
          <div>
            <h5 style="margin: 0; color: var(--text-main); font-size: 0.95rem;">Display Antrean TV</h5>
            <small style="color: var(--text-muted);">TV Ruang Tunggu</small>
          </div>
        </div>
      </a>
    </div>
  </div>

  <!-- Self Registration Banner for New Patients -->
  <div style="background: var(--primary-bg); border-radius: var(--radius-lg); padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; border: 1px dashed var(--primary); margin-bottom: 2rem;">
    <div class="flex items-center gap-3">
      <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--primary); color: #FFF; display: flex; align-items: center; justify-content: center;">
        <i data-lucide="user-plus" style="width: 24px;"></i>
      </div>
      <div>
        <h4 style="margin: 0; color: var(--primary); font-size: 1rem;">Belum Memiliki Akun / Pasien Baru?</h4>
        <p style="margin: 0.15rem 0 0; font-size: 0.85rem; color: var(--text-muted);">Daftar mandiri dalam 1 menit untuk mendapatkan Nomor Rekam Medis (RM) & Health Passport.</p>
      </div>
    </div>
    <a href="daftar.php" class="btn btn-primary btn-sm flex items-center gap-1" style="white-space: nowrap; text-decoration: none;">
      <i data-lucide="arrow-right" style="width: 16px;"></i> Registrasi Sekarang
    </a>
  </div>

  <form onsubmit="handleLoginSubmit(event)" style="display: flex; flex-direction: column; gap: 1.25rem;">
    <div class="form-group" style="margin-bottom: 0;">
      <label class="form-label" style="font-weight: 600;">Username / NIK / Email Medis</label>
      <input type="text" id="login-user" class="form-control" placeholder="Contoh: dokter_agus atau 3175081205900001" required />
    </div>

    <div class="form-group" style="margin-bottom: 0;">
      <label class="form-label" style="font-weight: 600;">Kata Sandi / PIN Keamanan</label>
      <input type="password" id="login-pass" class="form-control" placeholder="••••••••" required />
    </div>

    <button type="submit" class="btn btn-primary" style="padding: 0.9rem; font-size: 1.05rem; font-weight: 600;">
      <i data-lucide="log-in"></i> Masuk ke Sistem Informasi
    </button>
  </form>
</div>

<script>
  function handleLoginSubmit(e) {
    e.preventDefault();
    const user = document.getElementById('login-user').value.toLowerCase();
    showToast("Autentikasi Berhasil! Mengalihkan ke dashboard...", "success");
    setTimeout(() => {
      if (user.includes('dokter') || user.includes('agus')) location.href = 'dokter.php';
      else if (user.includes('apotek') || user.includes('obat')) location.href = 'apotek.php';
      else if (user.includes('kasir') || user.includes('bayar')) location.href = 'kasir.php';
      else if (user.includes('admin')) location.href = 'admin.php';
      else location.href = 'pasien.php';
    }, 800);
  }
</script>
