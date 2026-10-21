<!-- Quick Queue & Patient Hub Section (3-Column Command Layout on Widescreen) -->
<section id="quick-queue-section" style="margin-bottom: 4.5rem; width: 100%;">
  <div style="display: grid; grid-template-columns: 1fr 1.65fr 1.05fr; gap: 2rem; align-items: stretch; width: 100%; box-sizing: border-box;">
    
    <!-- LEFT COLUMN: Alur Pelayanan Pasien FKTP & TV Monitor Link -->
    <div class="card" style="padding: 2rem; border-top: 5px solid var(--primary); display: flex; flex-direction: column; justify-content: space-between; background: var(--bg-card); box-shadow: var(--shadow-sm); border-radius: var(--radius-xl);">
      <div>
        <div class="flex items-center gap-2.5" style="margin-bottom: 1.25rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: var(--bg-subtle); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i data-lucide="list-ordered" style="width: 22px; height: 22px;"></i>
          </div>
          <div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--text-dark); margin: 0;">Alur Pelayanan Pasien</h3>
            <small style="color: var(--text-muted); font-weight: 600;">Petunjuk Kunjungan FKTP</small>
          </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.1rem; margin-bottom: 1.5rem;">
          <div class="flex items-start gap-3">
            <span style="width: 28px; height: 28px; border-radius: 50%; background: var(--primary); color: #FFF; font-weight: 800; font-size: 0.88rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">1</span>
            <div>
              <strong style="font-size: 0.95rem; color: var(--text-dark); display: block;">Ambil Tiket Antrean</strong>
              <small style="color: var(--text-muted); line-height: 1.4; display: block;">Isi nama & tujuan poli pada loket mandiri di samping.</small>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <span style="width: 28px; height: 28px; border-radius: 50%; background: var(--bg-subtle); color: var(--primary); font-weight: 800; font-size: 0.88rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1.5px solid var(--border-color);">2</span>
            <div>
              <strong style="font-size: 0.95rem; color: var(--text-dark); display: block;">Ruang Tunggu & TV Antrean</strong>
              <small style="color: var(--text-muted); line-height: 1.4; display: block;">Dengarkan panggilan audio otomatis di monitor ruang tunggu.</small>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <span style="width: 28px; height: 28px; border-radius: 50%; background: var(--bg-subtle); color: var(--primary); font-weight: 800; font-size: 0.88rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1.5px solid var(--border-color);">3</span>
            <div>
              <strong style="font-size: 0.95rem; color: var(--text-dark); display: block;">Pemeriksaan Dokter EMR</strong>
              <small style="color: var(--text-muted); line-height: 1.4; display: block;">Konsultasi medis & diagnosis terintegrasi SATUSEHAT.</small>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <span style="width: 28px; height: 28px; border-radius: 50%; background: var(--bg-subtle); color: var(--primary); font-weight: 800; font-size: 0.88rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1.5px solid var(--border-color);">4</span>
            <div>
              <strong style="font-size: 0.95rem; color: var(--text-dark); display: block;">Ambil Obat di Farmasi</strong>
              <small style="color: var(--text-muted); line-height: 1.4; display: block;">Dispensing cepat dengan notifikasi WhatsApp saat siap.</small>
            </div>
          </div>
        </div>
      </div>

      <div style="padding-top: 1.25rem; border-top: 1px solid var(--border-color);">
        <a href="antrian-tv.php" target="_blank" class="btn btn-outline btn-sm" style="width: 100%; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-weight: 700;">
          <i data-lucide="tv" style="width: 16px;"></i> Buka Layar Antrean TV
        </a>
      </div>
    </div>

    <!-- CENTER COLUMN (HERO FOCUS): Interactive Loket Antrean Form -->
    <div class="card" style="padding: 2.25rem 2.5rem; border-radius: var(--radius-xl); box-shadow: 0 10px 30px rgba(30, 57, 38, 0.12); border: 2.5px solid var(--primary); background: var(--bg-card); position: relative;">
      
      <!-- Top Accent Badge -->
      <div style="text-align: center; margin-bottom: 1.75rem;">
        <span class="badge badge-primary" style="margin-bottom: 0.6rem; padding: 0.45rem 1.2rem; font-weight: 800; letter-spacing: 0.05em; font-size: 0.88rem;">
          <i data-lucide="ticket" style="width: 16px;"></i> PENDAFTARAN ANTREAN MANDIRI
        </span>
        <h2 style="font-size: 2rem; color: var(--primary); font-weight: 900; margin: 0.25rem 0 0.4rem; letter-spacing: -0.01em;">
          Ambil Nomor Antrean
        </h2>
        <p style="font-size: 0.98rem; color: var(--text-muted); margin: 0;">Pelayanan bagi prajurit siswa, personel organik, Persit KCK, serta pasien BPJS dan umum.</p>
      </div>

      <!-- Live Calling Status Bar -->
      <div style="display: flex; gap: 1rem; margin-bottom: 1.75rem; padding: 1.1rem 1.5rem; background: var(--bg-subtle); border-radius: var(--radius-lg); border: 1.5px solid var(--border-color);">
        <div style="flex: 1; text-align: center; border-right: 2px solid var(--border-color);">
          <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; font-weight: 800; letter-spacing: 0.05em;">Sedang Dilayani</span>
          <h3 style="color: var(--primary); font-size: 2.3rem; margin-top: 0.2rem; font-weight: 900; line-height: 1;">A-003</h3>
        </div>
        <div style="flex: 1; text-align: center;">
          <span style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; font-weight: 800; letter-spacing: 0.05em;">Nomor Berikutnya</span>
          <h3 style="color: #C2410C; font-size: 2.3rem; margin-top: 0.2rem; font-weight: 900; line-height: 1;">A-004</h3>
        </div>
      </div>

      <!-- Registration Form -->
      <form onsubmit="handleQuickQueueSubmit(event)" style="display: flex; flex-direction: column; gap: 1.25rem;">
        <div class="form-group" style="margin: 0;">
          <label class="form-label">Nama Lengkap atau NIK KTP *</label>
          <input type="text" id="quick-nama" placeholder="Contoh: Achmad Nurhadi atau 3175081205900001" value="Achmad Nurhadi" required />
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div class="form-group" style="margin: 0;">
            <label class="form-label">Tujuan Poliklinik *</label>
            <select id="quick-poli" required>
              <option value="Poli Umum">Poli Umum & Rikkes Prajurit</option>
              <option value="Poli Gigi">Poli Gigi & Mulut</option>
              <option value="Poli Penyakit Dalam">Poli Penyakit Dalam (Sp.PD)</option>
              <option value="Poli KIA">Poli KIA / KB (Persit KCK)</option>
              <option value="Laboratorium">Laboratorium Sederhana</option>
            </select>
          </div>
          <div class="form-group" style="margin: 0;">
            <label class="form-label">Kategori / Penjamin *</label>
            <select id="quick-penjamin" required>
              <option value="Dinas TNI-AD">Prajurit Siswa / Personel Organik Pusdikzi</option>
              <option value="Keluarga / Persit">Keluarga Militer / Anggota Persit KCK</option>
              <option value="BPJS Kesehatan">BPJS Kesehatan Faskes Tingkat 1</option>
              <option value="Umum / Pribadi">Pasien Umum (Non-BPJS / Tunai)</option>
            </select>
          </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
          <button type="submit" class="btn btn-primary" style="flex: 2; padding: 0.95rem; font-size: 1.05rem; font-weight: 800; box-shadow: 0 4px 14px rgba(30,57,38,0.35);">
            <i data-lucide="printer"></i> Ambil Tiket Antrean (A-004)
          </button>
          <a href="daftar.php" class="btn btn-outline" style="flex: 1; padding: 0.95rem; text-align: center; text-decoration: none; font-size: 0.95rem; font-weight: 700;">
            <i data-lucide="user-plus"></i> Daftar Pasien Baru
          </a>
        </div>
      </form>
    </div>

    <!-- RIGHT COLUMN: Live Quota & On-Duty Doctors -->
    <div class="card" style="padding: 2rem; border-top: 5px solid var(--accent); display: flex; flex-direction: column; justify-content: space-between; background: var(--bg-card); box-shadow: var(--shadow-sm); border-radius: var(--radius-xl);">
      <div>
        <div class="flex items-center gap-2.5" style="margin-bottom: 1.25rem;">
          <div style="width: 40px; height: 40px; border-radius: 10px; background: #FFEDD5; color: var(--accent); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            <i data-lucide="activity" style="width: 22px; height: 22px;"></i>
          </div>
          <div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--text-dark); margin: 0;">Sisa Kuota Layanan Poli</h3>
            <small style="color: var(--text-muted); font-weight: 600;">Dokter yang bertugas hari ini</small>
          </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 0.85rem; margin-bottom: 1.5rem;">
          <div style="padding: 0.75rem 0.9rem; background: var(--bg-subtle); border-radius: 8px; border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <div>
              <strong style="font-size: 0.92rem; color: var(--text-dark); display: block;">Poli Umum & Rikkes</strong>
              <small style="color: var(--text-muted);">dr. Siti Rahmawati</small>
            </div>
            <span class="badge badge-success" style="font-size: 0.82rem;">Tersisa 18</span>
          </div>

          <div style="padding: 0.75rem 0.9rem; background: var(--bg-subtle); border-radius: 8px; border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <div>
              <strong style="font-size: 0.92rem; color: var(--text-dark); display: block;">Poli Penyakit Dalam</strong>
              <small style="color: var(--text-muted);">dr. Agus Susanto, Sp.PD</small>
            </div>
            <span class="badge badge-warning" style="font-size: 0.82rem;">Tersisa 8</span>
          </div>

          <div style="padding: 0.75rem 0.9rem; background: var(--bg-subtle); border-radius: 8px; border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <div>
              <strong style="font-size: 0.92rem; color: var(--text-dark); display: block;">Poli Gigi & Mulut</strong>
              <small style="color: var(--text-muted);">drg. Hendra Wijaya</small>
            </div>
            <span class="badge badge-success" style="font-size: 0.82rem;">Tersisa 12</span>
          </div>

          <div style="padding: 0.75rem 0.9rem; background: var(--bg-subtle); border-radius: 8px; border: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <div>
              <strong style="font-size: 0.92rem; color: var(--text-dark); display: block;">UGD & Ambulans Salak</strong>
              <small style="color: var(--text-muted);">Siaga Paramedis 24 Jam</small>
            </div>
            <span class="badge badge-danger" style="font-size: 0.82rem;">Siaga 24 Jam</span>
          </div>
        </div>
      </div>

      <div style="padding: 0.85rem 1rem; background: #DCFCE7; border-radius: 8px; border: 1px solid #86EFAC; color: #166534; font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem;">
        <i data-lucide="clock" style="width: 18px; flex-shrink: 0;"></i>
        <span>Estimasi waktu tunggu: <strong>±8 menit</strong> per pasien</span>
      </div>
    </div>

  </div>
</section>
