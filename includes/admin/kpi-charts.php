<!-- ==========================================================================
     HEXABOX & DASHSPACE EXECUTIVE ANALYTICS & COMMAND CENTER
     ========================================================================== -->

<!-- 1. Hexabox Top Hero Banner -->
<div class="hexa-hero-banner">
  <div class="flex justify-between items-center flex-wrap gap-4" style="position: relative; z-index: 2;">
    <div>
      <div class="flex items-center gap-3" style="margin-bottom: 0.6rem;">
        <span class="hexa-live-badge">
          <span class="pulse-dot"></span>
          <span>SATUSEHAT & BPJS Terhubung</span>
        </span>
        <span style="font-size: 0.82rem; opacity: 0.85;">Kode Faskes: 0115B001 (Bogor Tengah)</span>
      </div>
      <h2 style="font-size: 1.85rem; font-weight: 800; margin: 0 0 0.4rem 0; letter-spacing: -0.02em; color: #FFFFFF;">
        Pusat Pemantauan Operasional Medis PUSDIKZI
      </h2>
      <p style="margin: 0; font-size: 0.92rem; opacity: 0.9; max-width: 650px; line-height: 1.5;">
        Pemantauan pelayanan medis, rekam medis elektronik Permenkes 24/2022, pengajuan klaim BPJS, dan utilisasi poliklinik.
      </p>
    </div>

    <div class="flex items-center gap-3 flex-wrap">
      <button class="btn btn-outline" style="background: rgba(255,255,255,0.12); color: #FFF; border-color: rgba(255,255,255,0.3); backdrop-filter: blur(6px);" onclick="window.print()">
        <i data-lucide="printer"></i> Cetak Laporan
      </button>
      <button class="btn btn-primary" style="background: #FFFFFF; color: #1E3926; box-shadow: 0 10px 25px rgba(0,0,0,0.2);" onclick="showToast('Menghubungkan rekam medis ke server SATUSEHAT...')">
        <i data-lucide="refresh-cw"></i> Sinkronisasi RME
      </button>
    </div>
  </div>
</div>

<!-- 2. Dashspace / Hexabox 4-Grid Elevated Metric Cards -->
<div class="grid grid-cols-4 gap-4" style="margin-bottom: 2rem;">
  <!-- Card 1: Total Pasien -->
  <div class="hexa-stat-card">
    <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
      <div>
        <span style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">KUNJUNGAN PASIEN BULAN INI</span>
        <h3 style="font-size: 1.85rem; font-weight: 900; color: #0F172A; margin: 0; letter-spacing: -0.02em;">1.428 <span style="font-size: 0.95rem; font-weight: 600; color: var(--text-muted);">Pasien</span></h3>
      </div>
      <div class="hexa-icon-box icon-box-emerald">
        <i data-lucide="users"></i>
      </div>
    </div>
    <div class="flex items-center justify-between" style="border-top: 1px solid #F1F5F9; padding-top: 0.75rem; font-size: 0.78rem;">
      <span class="hexa-trend-pill trend-up">
        <i data-lucide="trending-up" style="width: 14px; height: 14px;"></i> +14,8%
      </span>
      <span style="color: var(--text-muted);">dibanding bulan lalu</span>
    </div>
  </div>

  <!-- Card 2: Pendapatan & Klaim -->
  <div class="hexa-stat-card">
    <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
      <div>
        <span style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">TOTAL PENERIMAAN & KLAIM (YTD)</span>
        <h3 style="font-size: 1.85rem; font-weight: 900; color: #0F172A; margin: 0; letter-spacing: -0.02em;">Rp 184,5 <span style="font-size: 0.95rem; font-weight: 600; color: var(--text-muted);">Jt</span></h3>
      </div>
      <div class="hexa-icon-box icon-box-blue">
        <i data-lucide="wallet"></i>
      </div>
    </div>
    <div class="flex items-center justify-between" style="border-top: 1px solid #F1F5F9; padding-top: 0.75rem; font-size: 0.78rem;">
      <span class="hexa-trend-pill trend-up">
        <i data-lucide="trending-up" style="width: 14px; height: 14px;"></i> +8,4%
      </span>
      <span style="color: var(--text-muted);">92% dari target tahunan</span>
    </div>
  </div>

  <!-- Card 3: Rasio BPJS Cover -->
  <div class="hexa-stat-card">
    <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
      <div>
        <span style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">ANGKA KONTAK BPJS (KBK)</span>
        <h3 style="font-size: 1.85rem; font-weight: 900; color: #0F172A; margin: 0; letter-spacing: -0.02em;">84,2 <span style="font-size: 0.95rem; font-weight: 600; color: var(--text-muted);">%</span></h3>
      </div>
      <div class="hexa-icon-box icon-box-orange">
        <i data-lucide="shield-check"></i>
      </div>
    </div>
    <div class="flex items-center justify-between" style="border-top: 1px solid #F1F5F9; padding-top: 0.75rem; font-size: 0.78rem;">
      <span class="hexa-trend-pill trend-up" style="background: #FEF3C7; color: #B45309;">
        <i data-lucide="check-circle" style="width: 14px; height: 14px;"></i> Memenuhi Target
      </span>
      <span style="color: var(--text-muted);">Kapitasi Optimal 100%</span>
    </div>
  </div>

  <!-- Card 4: Waktu Tunggu Layanan -->
  <div class="hexa-stat-card">
    <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
      <div>
        <span style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">WAKTU TUNGGU RATA-RATA</span>
        <h3 style="font-size: 1.85rem; font-weight: 900; color: #0F172A; margin: 0; letter-spacing: -0.02em;">11,5 <span style="font-size: 0.95rem; font-weight: 600; color: var(--text-muted);">Menit</span></h3>
      </div>
      <div class="hexa-icon-box icon-box-purple">
        <i data-lucide="clock"></i>
      </div>
    </div>
    <div class="flex items-center justify-between" style="border-top: 1px solid #F1F5F9; padding-top: 0.75rem; font-size: 0.78rem;">
      <span class="hexa-trend-pill trend-up">
        <i data-lucide="arrow-down" style="width: 14px; height: 14px;"></i> -3,2 Menit
      </span>
      <span style="color: var(--text-muted);">Standar < 15 Menit</span>
    </div>
  </div>
</div>

<!-- 3. Hexabox Interactive Analytics Charts -->
<div class="grid grid-cols-3 gap-6" style="margin-bottom: 2rem;">
  <!-- Left Chart: Trend Kunjungan (Area Smooth Curve) -->
  <div class="card" style="grid-column: span 2; padding: 1.75rem; border-radius: var(--radius-xl); border: 1px solid rgba(226,232,240,0.8); box-shadow: 0 10px 30px rgba(15,23,42,0.04);">
    <div class="flex justify-between items-center" style="margin-bottom: 1.25rem;">
      <div>
        <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 0.2rem 0;">Statistik Kunjungan Pasien & Utilisasi JKN</h3>
        <p style="font-size: 0.82rem; color: var(--text-muted); margin: 0;">Perbandingan Pasien BPJS Kesehatan vs Pasien Umum 7 Hari Terakhir</p>
      </div>
      <div class="flex items-center gap-2">
        <span class="badge" style="background: #E8EFEA; color: #1E3926; font-size: 0.75rem; font-weight: 700;">Minggu Ini</span>
      </div>
    </div>
    <div style="height: 280px; position: relative;">
      <canvas id="chart-kunjungan"></canvas>
    </div>
  </div>

  <!-- Right Chart: Donut Diagnosa Terbanyak -->
  <div class="card" style="padding: 1.75rem; border-radius: var(--radius-xl); border: 1px solid rgba(226,232,240,0.8); box-shadow: 0 10px 30px rgba(15,23,42,0.04);">
    <div class="flex justify-between items-center" style="margin-bottom: 1.25rem;">
      <div>
        <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 0.2rem 0;">Top 5 Diagnosa (ICD-10)</h3>
        <p style="font-size: 0.82rem; color: var(--text-muted); margin: 0;">Penyakit terbanyak bulan ini</p>
      </div>
    </div>
    <div style="height: 200px; position: relative; margin-bottom: 1rem;">
      <canvas id="chart-penyakit"></canvas>
    </div>
    <div style="font-size: 0.78rem; display: flex; flex-direction: column; gap: 0.4rem;">
      <div class="flex justify-between items-center">
        <span class="flex items-center gap-2"><span style="width: 10px; height: 10px; border-radius: 50%; background: #1E3926;"></span> Hipertensi Primer (I10)</span>
        <strong>34%</strong>
      </div>
      <div class="flex justify-between items-center">
        <span class="flex items-center gap-2"><span style="width: 10px; height: 10px; border-radius: 50%; background: #10B981;"></span> ISPA Akut (J06.9)</span>
        <strong>26%</strong>
      </div>
      <div class="flex justify-between items-center">
        <span class="flex items-center gap-2"><span style="width: 10px; height: 10px; border-radius: 50%; background: #F59E0B;"></span> Diabetes Mellitus (E11)</span>
        <strong>18%</strong>
      </div>
      <div class="flex justify-between items-center">
        <span class="flex items-center gap-2"><span style="width: 10px; height: 10px; border-radius: 50%; background: #0284C7;"></span> Dispepsia / Gastritis (K30)</span>
        <strong>14%</strong>
      </div>
      <div class="flex justify-between items-center">
        <span class="flex items-center gap-2"><span style="width: 10px; height: 10px; border-radius: 50%; background: #8B5CF6;"></span> Karies Gigi (K02.1)</span>
        <strong>8%</strong>
      </div>
    </div>
  </div>
</div>

<!-- 4. Live Operational Feed & Doctor Duty Schedule -->
<div class="grid grid-cols-3 gap-6">
  <!-- Left Table: Live Queue Status (65%) -->
  <div class="card" style="grid-column: span 2; padding: 1.75rem; border-radius: var(--radius-xl); border: 1px solid rgba(226,232,240,0.8); box-shadow: 0 10px 30px rgba(15,23,42,0.04);">
    <div class="flex justify-between items-center" style="margin-bottom: 1.25rem;">
      <div>
        <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0 0 0.2rem 0;">Status Antrean Pelayanan Hari Ini (Live)</h3>
        <p style="font-size: 0.82rem; color: var(--text-muted); margin: 0;">Sinkronisasi otomatis dengan layar Display Antrean & SATUSEHAT</p>
      </div>
      <span class="badge badge-success" style="display: flex; align-items: center; gap: 0.35rem;">
        <span class="pulse-dot" style="width: 6px; height: 6px;"></span> Realtime Active
      </span>
    </div>

    <div style="overflow-x: auto;">
      <table class="table" style="width: 100%;">
        <thead>
          <tr>
            <th>Antrean</th>
            <th>Nama Pasien</th>
            <th>Poli Tujuan</th>
            <th>Dokter DPJP</th>
            <th>Penjamin</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong style="color: var(--primary); font-size: 1.05rem;">A-004</strong></td>
            <td>
              <div class="flex items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: #E8EFEA; color: #1E3926; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.78rem;">AN</div>
                <div><strong>Achmad Nurhadi</strong><br/><small style="color: var(--text-muted);">RM-2026-0881</small></div>
              </div>
            </td>
            <td>Poli Spesialis Penyakit Dalam</td>
            <td>dr. Agus Susanto, Sp.PD</td>
            <td><span class="badge badge-success">BPJS Faskes 1</span></td>
            <td><span class="badge badge-warning" style="animation: pulseGreen 2s infinite;">Sedang Diperiksa</span></td>
          </tr>
          <tr>
            <td><strong style="color: var(--primary); font-size: 1.05rem;">A-005</strong></td>
            <td>
              <div class="flex items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: #FEF3C7; color: #B45309; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.78rem;">HK</div>
                <div><strong>Hendra Kusuma</strong><br/><small style="color: var(--text-muted);">RM-2026-0551</small></div>
              </div>
            </td>
            <td>Poli Gigi & Mulut</td>
            <td>drg. Budi Santoso</td>
            <td><span class="badge badge-primary">Umum Mandiri</span></td>
            <td><span class="badge badge-primary">Menunggu Obat</span></td>
          </tr>
          <tr>
            <td><strong style="color: var(--primary); font-size: 1.05rem;">A-006</strong></td>
            <td>
              <div class="flex items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 50%; background: #E0F2FE; color: #0284C7; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.78rem;">SA</div>
                <div><strong>Ibu Siti Aminah</strong><br/><small style="color: var(--text-muted);">RM-2026-0412</small></div>
              </div>
            </td>
            <td>Poli Umum</td>
            <td>dr. Siti Rahmawati</td>
            <td><span class="badge badge-success">BPJS Faskes 1</span></td>
            <td><span class="badge badge-success">Selesai Berobat</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Right Card: Doctor Duty Schedule (35%) -->
  <div class="card" style="padding: 1.75rem; border-radius: var(--radius-xl); border: 1px solid rgba(226,232,240,0.8); box-shadow: 0 10px 30px rgba(15,23,42,0.04);">
    <div class="flex justify-between items-center" style="margin-bottom: 1.25rem;">
      <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0;">Dokter Jaga Hari Ini</h3>
      <span class="badge badge-primary" style="font-size: 0.75rem;">3 Dokter Aktif</span>
    </div>

    <div style="display: flex; flex-direction: column; gap: 1rem;">
      <!-- Doctor 1 -->
      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1rem; border-radius: 12px;">
        <div class="flex justify-between items-start" style="margin-bottom: 0.4rem;">
          <div>
            <strong style="font-size: 0.92rem; color: #0F172A; display: block;">dr. Agus Susanto, Sp.PD</strong>
            <small style="color: var(--primary); font-weight: 700;">Spesialis Penyakit Dalam</small>
          </div>
          <span class="badge badge-success" style="font-size: 0.7rem;">Poli 1 (Aktif)</span>
        </div>
        <div style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-muted);">
          <div class="flex justify-between" style="margin-bottom: 0.2rem;">
            <span>Kapasitas Pasien:</span>
            <strong>18 / 25 Pasien (72%)</strong>
          </div>
          <div style="height: 6px; background: #E2E8F0; border-radius: 99px; overflow: hidden;">
            <div style="width: 72%; height: 100%; background: #1E3926; border-radius: 99px;"></div>
          </div>
        </div>
      </div>

      <!-- Doctor 2 -->
      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1rem; border-radius: 12px;">
        <div class="flex justify-between items-start" style="margin-bottom: 0.4rem;">
          <div>
            <strong style="font-size: 0.92rem; color: #0F172A; display: block;">dr. Siti Rahmawati</strong>
            <small style="color: var(--primary); font-weight: 700;">Poli Umum & MCU</small>
          </div>
          <span class="badge badge-success" style="font-size: 0.7rem;">Poli 2 (Aktif)</span>
        </div>
        <div style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-muted);">
          <div class="flex justify-between" style="margin-bottom: 0.2rem;">
            <span>Kapasitas Pasien:</span>
            <strong>12 / 30 Pasien (40%)</strong>
          </div>
          <div style="height: 6px; background: #E2E8F0; border-radius: 99px; overflow: hidden;">
            <div style="width: 40%; height: 100%; background: #0284C7; border-radius: 99px;"></div>
          </div>
        </div>
      </div>

      <!-- Doctor 3 -->
      <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 1rem; border-radius: 12px;">
        <div class="flex justify-between items-start" style="margin-bottom: 0.4rem;">
          <div>
            <strong style="font-size: 0.92rem; color: #0F172A; display: block;">drg. Budi Santoso</strong>
            <small style="color: var(--primary); font-weight: 700;">Poli Gigi & Mulut</small>
          </div>
          <span class="badge badge-success" style="font-size: 0.7rem;">Poli Gigi (Aktif)</span>
        </div>
        <div style="margin-top: 0.5rem; font-size: 0.75rem; color: var(--text-muted);">
          <div class="flex justify-between" style="margin-bottom: 0.2rem;">
            <span>Kapasitas Pasien:</span>
            <strong>8 / 15 Pasien (53%)</strong>
          </div>
          <div style="height: 6px; background: #E2E8F0; border-radius: 99px; overflow: hidden;">
            <div style="width: 53%; height: 100%; background: #F59E0B; border-radius: 99px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
