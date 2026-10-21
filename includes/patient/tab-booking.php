<!-- Tab 2: Booking Kunjungan -->
<div id="tab-booking" class="tab-pane" style="display: none;">
  <div style="margin-bottom: 1.5rem;">
    <h2 style="font-size: 1.75rem; color: var(--primary);">Pendaftaran Kunjungan & Antrean Online</h2>
    <p style="color: var(--text-light);">Pilih poliklinik dan dokter yang dituju untuk mendapatkan nomor antrean kunjungan.</p>
  </div>

  <div class="card" style="max-width: 700px; padding: 2rem;">
    <form onsubmit="handlePatientBooking(event)" style="display: flex; flex-direction: column; gap: 1.25rem;">
      <div class="form-group" style="margin-bottom: 0;">
        <label class="form-label" style="font-weight: 600;">Pilih Poliklinik Layanan</label>
        <select id="book-poli" class="form-control" required>
          <option value="Poli Umum">Poli Umum & Medical Check Up</option>
          <option value="Poli Penyakit Dalam">Poli Penyakit Dalam (Sp.PD)</option>
          <option value="Poli Gigi">Poli Gigi & Mulut</option>
          <option value="Poli KIA">Poli Ibu & Anak (KIA/KB)</option>
        </select>
      </div>

      <div class="form-group" style="margin-bottom: 0;">
        <label class="form-label" style="font-weight: 600;">Pilih Dokter Praktik</label>
        <select id="book-dokter" class="form-control" required>
          <option value="dr. Agus Susanto, Sp.PD">dr. Agus Susanto, Sp.PD (08:00 - 13:00)</option>
          <option value="dr. Siti Rahmawati">dr. Siti Rahmawati (13:00 - 18:00)</option>
        </select>
      </div>

      <div class="form-group" style="margin-bottom: 0;">
        <label class="form-label" style="font-weight: 600;">Keluhan Utama / Gejala</label>
        <textarea id="book-keluhan" class="form-control" rows="3" placeholder="Contoh: Demam sejak 2 hari yang lalu..." required></textarea>
      </div>

      <button type="submit" class="btn btn-primary" style="padding: 0.9rem; font-weight: 700;">
        <i data-lucide="check"></i> Konfirmasi Booking Antrean
      </button>
    </form>
  </div>
</div>
