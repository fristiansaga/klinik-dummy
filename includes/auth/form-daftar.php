<!-- Form Pendaftaran Pasien Baru Mandiri -->
<div class="card" style="max-width: 800px; width: 100%; padding: 2.5rem; box-shadow: var(--shadow-lg); border-radius: var(--radius-xl);">
  <div style="text-align: center; margin-bottom: 2rem;">
    <span class="badge badge-primary" style="margin-bottom: 0.5rem;">
      <i data-lucide="user-plus"></i> Self-Service Registration
    </span>
    <h2 style="font-size: 2rem; color: var(--primary);">Pendaftaran Pasien Baru</h2>
    <p style="color: var(--text-light); max-width: 550px; margin: 0.5rem auto 0;">
      Daftarkan diri Anda untuk mendapatkan <strong>Nomor Rekam Medis (No. RM)</strong> dan <strong>Digital Health Passport</strong> resmi KLINIK PRATAMA PUSDIKZI.
    </p>
  </div>

  <form onsubmit="handleRegistrationSubmit(event)" style="display: flex; flex-direction: column; gap: 1.25rem;">
    <div class="grid grid-cols-2 gap-4">
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Nomor Induk Kependudukan (NIK) *</label>
        <input type="text" id="reg-nik" class="form-control" placeholder="16 Digit NIK KTP..." maxlength="16" required />
      </div>
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Nama Lengkap (Sesuai KTP) *</label>
        <input type="text" id="reg-nama" class="form-control" placeholder="Nama lengkap tanpa singkatan..." required />
      </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Tanggal Lahir *</label>
        <input type="date" id="reg-tgl-lahir" class="form-control" value="1995-01-01" required />
      </div>
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Jenis Kelamin *</label>
        <select id="reg-gender" class="form-control" required>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Golongan Darah</label>
        <select id="reg-goldar" class="form-control">
          <option value="O (Positif)">O (Positif)</option>
          <option value="A (Positif)">A (Positif)</option>
          <option value="B (Positif)">B (Positif)</option>
          <option value="AB (Positif)">AB (Positif)</option>
        </select>
      </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Nomor WhatsApp / HP Aktif *</label>
        <input type="tel" id="reg-hp" class="form-control" placeholder="0812xxxxxxxx" required />
      </div>
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Jenis Penjamin Biaya *</label>
        <select id="reg-penjamin" class="form-control" onchange="toggleBpjsField()" required>
          <option value="BPJS Kesehatan">BPJS Kesehatan (Faskes 1)</option>
          <option value="Pasien Umum / Tunai">Pasien Umum / Pembayaran Mandiri</option>
          <option value="Dinas TNI-AD / PNS">Anggota Dinas TNI-AD / PNS / Keluarga</option>
        </select>
      </div>
    </div>

    <div id="bpjs-group" class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Nomor Kartu BPJS / KIS (13 Digit)</label>
      <input type="text" id="reg-bpjs" class="form-control" placeholder="Contoh: 0001892837482" maxlength="13" />
    </div>

    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Riwayat Alergi Obat / Makanan (Bila Ada)</label>
      <input type="text" id="reg-alergi" class="form-control" placeholder="Misal: Alergi Amoxicillin, Seafood, Debu (Tulis 'Tidak Ada' bila nihil)" />
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Buat PIN Keamanan (6 Angka) *</label>
        <input type="password" id="reg-pin" class="form-control" placeholder="••••••" maxlength="6" required />
      </div>
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-weight: 600;">Konfirmasi PIN *</label>
        <input type="password" id="reg-pin2" class="form-control" placeholder="••••••" maxlength="6" required />
      </div>
    </div>

    <button type="submit" class="btn btn-primary" style="padding: 1rem; font-size: 1.05rem; font-weight: 700; margin-top: 0.5rem;">
      <i data-lucide="check-circle-2"></i> Daftarkan & Dapatkan Health Passport Digital
    </button>
  </form>
</div>

<script>
  function toggleBpjsField() {
    const penjamin = document.getElementById('reg-penjamin').value;
    const bpjsGroup = document.getElementById('bpjs-group');
    if (penjamin === 'BPJS Kesehatan') {
      bpjsGroup.style.display = 'block';
    } else {
      bpjsGroup.style.display = 'none';
    }
  }

  function handleRegistrationSubmit(e) {
    e.preventDefault();
    const pin = document.getElementById('reg-pin').value;
    const pin2 = document.getElementById('reg-pin2').value;

    if (pin !== pin2) {
      alert("Konfirmasi PIN tidak cocok! Silakan cek kembali.");
      return;
    }

    const randomRm = `RM-2026-${Math.floor(1000 + Math.random() * 9000)}`;
    showToast(`Registrasi Berhasil! Nomor RM Anda: ${randomRm}`, "success");
    setTimeout(() => {
      location.href = 'pasien.php';
    }, 1200);
  }
</script>
