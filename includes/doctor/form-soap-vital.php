<!-- Form EMR SOAP + POCT Rapid Diagnostics -->
<form onsubmit="handleSoapSubmit(event)" style="display: flex; flex-direction: column; gap: 1.5rem;">
  <!-- Patient Header Summary -->
  <div class="card flex items-center justify-between" style="padding: 1rem 1.5rem; background: var(--bg-main); border-left: 5px solid var(--primary);">
    <div>
      <span style="font-size: 0.8rem; color: var(--text-light);">PASIEN SEDANG DIPERIKSA:</span>
      <h3 style="margin: 0.2rem 0; font-size: 1.25rem;">Achmad Nurhadi (RM-2026-0881)</h3>
      <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Laki-laki • 36 Th • BPJS Kesehatan • Alergi: Amoxicillin, Seafood</p>
    </div>
    <span class="badge badge-primary" style="font-size: 1.2rem; padding: 0.5rem 1rem;">A-004</span>
  </div>

  <!-- S: Subjektif -->
  <div class="form-group" style="margin: 0;">
    <label class="form-label" style="font-weight: 700; color: var(--primary);">[S] Subjektif / Anamnesis Pasien</label>
    <textarea class="form-control" rows="2" placeholder="Keluhan utama, riwayat penyakit sekarang..." required>Pasien mengeluh demam sejak 2 hari yang lalu disertai batuk berdahak dan sakit kepala. Tidak ada sesak napas.</textarea>
  </div>

  <!-- O: Objektif & Vital Signs & POCT Lab -->
  <div class="form-group" style="margin: 0;">
    <label class="form-label" style="font-weight: 700; color: var(--primary);">[O] Objektif / Tanda Vital & Lab Cepat (POCT)</label>
    
    <div class="grid grid-cols-4 gap-3" style="margin-bottom: 0.75rem;">
      <div>
        <label style="font-size: 0.75rem; color: var(--text-muted);">Tekanan Darah</label>
        <input type="text" class="form-control" value="120/80 mmHg" required />
      </div>
      <div>
        <label style="font-size: 0.75rem; color: var(--text-muted);">Suhu Tubuh</label>
        <input type="text" class="form-control" value="38.2 °C" required />
      </div>
      <div>
        <label style="font-size: 0.75rem; color: var(--text-muted);">Nadi</label>
        <input type="text" class="form-control" value="84 x/menit" required />
      </div>
      <div>
        <label style="font-size: 0.75rem; color: var(--text-muted);">SpO2</label>
        <input type="text" class="form-control" value="98 %" required />
      </div>
    </div>

    <!-- POCT Lab Rapid Diagnostics -->
    <div class="card" style="padding: 1rem 1.25rem; background: var(--primary-bg); margin-bottom: 0.75rem;">
      <span style="font-size: 0.8rem; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 0.4rem; margin-bottom: 0.5rem;">
        <i data-lucide="flask-conical" style="width: 16px;"></i> Hasil Lab Cepat (POCT Ruang Periksa)
      </span>
      <div class="grid grid-cols-4 gap-3">
        <div>
          <label style="font-size: 0.75rem;">GDS (mg/dL)</label>
          <input type="number" class="form-control form-control-sm" value="110" />
        </div>
        <div>
          <label style="font-size: 0.75rem;">Kolesterol (mg/dL)</label>
          <input type="number" class="form-control form-control-sm" value="175" />
        </div>
        <div>
          <label style="font-size: 0.75rem;">Asam Urat (mg/dL)</label>
          <input type="number" step="0.1" class="form-control form-control-sm" value="5.4" />
        </div>
        <div>
          <label style="font-size: 0.75rem;">Hb (g/dL)</label>
          <input type="number" step="0.1" class="form-control form-control-sm" value="14.2" />
        </div>
      </div>
    </div>

    <textarea class="form-control" rows="2" placeholder="Pemeriksaan fisik spesifik...">Faring hiperemis (+), tonsil T1-T1 tenang, rhonki (-/-), wheezing (-/-), abdomen supel datar.</textarea>
  </div>

  <!-- A: Asesmen & ICD-10 -->
  <div class="form-group" style="margin: 0;">
    <label class="form-label" style="font-weight: 700; color: var(--primary);">[A] Asesmen / Diagnosa Primer & Sekunder (ICD-10)</label>
    <div class="grid grid-cols-3 gap-3">
      <div>
        <label style="font-size: 0.75rem; color: var(--text-muted);">Kode ICD-10</label>
        <input type="text" class="form-control" value="J00" required />
      </div>
      <div style="grid-column: span 2;">
        <label style="font-size: 0.75rem; color: var(--text-muted);">Nama Diagnosa Resmi</label>
        <input type="text" class="form-control" value="Nasopharyngitis acuta [common cold] / ISPA Akut" required />
      </div>
    </div>
  </div>

  <!-- P: Plan & E-Resep -->
  <div class="form-group" style="margin: 0;">
    <label class="form-label" style="font-weight: 700; color: var(--primary);">[P] Plan / Terapi & Peresepan Elektronik (E-Prescription)</label>
    <div class="card" style="padding: 1rem; background: var(--bg-main);">
      <div class="grid grid-cols-3 gap-2" style="margin-bottom: 0.5rem;">
        <div style="grid-column: span 2;">
          <input type="text" class="form-control" value="Paracetamol 500mg [Merek: Sanmol - Sanbe] (10 Tab) - 3x1 sesudah makan" />
        </div>
        <div>
          <input type="text" class="form-control" value="Ambroxol 30mg [Kimia Farma] (10 Tab) - 3x1" />
        </div>
      </div>
      <small style="color: var(--text-muted);">*E-resep mendukung nama zat aktif generik dan merek dagang pabrik terintegrasi SATUSEHAT & apotek.</small>
    </div>
  </div>

  <!-- Tindak Lanjut & Status Pelayanan -->
  <div class="form-group" style="margin: 0;">
    <label class="form-label" style="font-weight: 700; color: var(--primary);">Tindak Lanjut & Rujukan Medis</label>
    <div class="grid grid-cols-3 gap-3" style="margin-bottom: 0.75rem;">
      <label class="card flex items-center gap-2" style="padding: 0.75rem 1rem; cursor: pointer; border: 1.5px solid var(--primary); background: var(--primary-bg);">
        <input type="radio" name="tindak_lanjut" value="selesai" checked onclick="document.getElementById('rujukan-fields-soap').style.display = 'none';" />
        <strong style="font-size: 0.85rem;">1. Selesai Rawat Jalan</strong>
      </label>
      <label class="card flex items-center gap-2" style="padding: 0.75rem 1rem; cursor: pointer; border: 1.5px solid var(--border-color);" onclick="document.getElementById('rujukan-fields-soap').style.display = 'block';">
        <input type="radio" name="tindak_lanjut" value="rujuk" />
        <strong style="font-size: 0.85rem; color: var(--accent);">2. Rujuk ke Rumah Sakit</strong>
      </label>
      <label class="card flex items-center gap-2" style="padding: 0.75rem 1rem; cursor: pointer; border: 1.5px solid var(--border-color);" onclick="document.getElementById('rujukan-fields-soap').style.display = 'none';">
        <input type="radio" name="tindak_lanjut" value="rawat_inap" />
        <strong style="font-size: 0.85rem;">3. Observasi IGD</strong>
      </label>
    </div>

    <!-- Conditional Rujukan Fields in SOAP -->
    <div id="rujukan-fields-soap" class="card" style="padding: 1rem 1.25rem; background: #FFFBEB; border: 1.5px solid #FCD34D; display: none;">
      <div style="font-weight: 800; font-size: 0.85rem; color: #92400E; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem;">
        <i data-lucide="send" style="width: 16px;"></i> Data Rujukan Faskes Lanjutan (FKRTL / RS)
      </div>
      <div class="grid grid-cols-2 gap-3" style="font-size: 0.85rem;">
        <div>
          <label style="font-size: 0.75rem; color: #78350F; font-weight: 600;">Rumah Sakit Rujukan Tujuan</label>
          <select class="form-control form-control-sm">
            <option value="RS Tk. IV 03.04.02 Salak Bogor">RS Tk. IV 03.04.02 Salak Bogor (RST Salak)</option>
            <option value="RSUD Kota Bogor">RSUD Kota Bogor</option>
            <option value="RSPAD Gatot Soebroto">RSPAD Gatot Soebroto</option>
          </select>
        </div>
        <div>
          <label style="font-size: 0.75rem; color: #78350F; font-weight: 600;">Poli Spesialis yang Dituju</label>
          <input type="text" class="form-control form-control-sm" value="Spesialis Penyakit Dalam (Sp.PD)" />
        </div>
        <div style="grid-column: span 2;">
          <label style="font-size: 0.75rem; color: #78350F; font-weight: 600;">Alasan Rujukan</label>
          <input type="text" class="form-control form-control-sm" value="Pemeriksaan lanjutan & penanganan spesialis" />
        </div>
      </div>
    </div>
  </div>

  <div class="flex gap-3">
    <button type="submit" class="btn btn-primary" style="flex: 2; padding: 1rem; font-weight: 700;">
      <i data-lucide="save"></i> Simpan Rekam Medis EMR & Kirim E-Resep
    </button>
    <button type="button" class="btn btn-outline" style="flex: 1;" onclick="showTab('surat_medis')">
      <i data-lucide="file-text"></i> Buat Surat Medis / Rujukan
    </button>
  </div>
</form>
