<!-- Form Generator Surat Medis Resmi (Surat Sakit / Sehat / Rujukan) -->
<form onsubmit="handleGenerateCertificate(event)" style="display: flex; flex-direction: column; gap: 1.25rem;">
  <div class="grid grid-cols-2 gap-4">
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Jenis Surat Keterangan Medis *</label>
      <select id="cert-type" class="form-control" onchange="toggleCertFields()" required>
        <option value="Surat Keterangan Sakit (Izin Istirahat)">Surat Keterangan Sakit (Izin Istirahat)</option>
        <option value="Surat Keterangan Berbadan Sehat (SKBS)">Surat Keterangan Berbadan Sehat (SKBS)</option>
        <option value="Surat Rujukan Pasien Eksternal (BPJS/RS)">Surat Rujukan Pasien Eksternal (BPJS / RS Salak)</option>
      </select>
    </div>
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Nama Pasien</label>
      <input type="text" id="cert-nama" class="form-control" value="Achmad Nurhadi (RM-2026-0881)" readonly />
    </div>
  </div>

  <!-- Fields for Surat Sakit -->
  <div id="cert-sakit-fields" class="grid grid-cols-2 gap-4">
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Lama Waktu Istirahat (Hari)</label>
      <input type="number" id="cert-days" class="form-control" value="2" min="1" max="14" />
    </div>
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Mulai Tanggal</label>
      <input type="date" id="cert-start-date" class="form-control" value="2026-08-30" />
    </div>
  </div>

  <!-- Fields for Surat Rujukan (Hidden by default) -->
  <div id="cert-rujukan-fields" class="grid grid-cols-2 gap-4" style="display: none; background: #FFFBEB; padding: 1rem; border-radius: 10px; border: 1.5px solid #FCD34D;">
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600; color: #92400E;">Rumah Sakit Rujukan Tujuan</label>
      <select id="cert-rs-tujuan" class="form-control">
        <option value="RS Tk. IV 03.04.02 Salak Bogor (RST Salak)">RS Tk. IV 03.04.02 Salak Bogor (RST Salak)</option>
        <option value="RSUD Kota Bogor">RSUD Kota Bogor</option>
        <option value="RSPAD Gatot Soebroto">RSPAD Gatot Soebroto</option>
        <option value="RS PMI Kota Bogor">RS PMI Kota Bogor</option>
      </select>
    </div>
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600; color: #92400E;">Poli Spesialis yang Dituju</label>
      <input type="text" id="cert-poli-tujuan" class="form-control" value="Spesialis Penyakit Dalam (Sp.PD)" />
    </div>
  </div>

  <div class="form-group" style="margin: 0;">
    <label class="form-label" style="font-weight: 600;">Diagnosa Medis / Keperluan / Alasan Rujuk</label>
    <input type="text" id="cert-keperluan" class="form-control" value="Febris H-2 ec Susp. Viral Infection / Perlu Istirahat Fisik" required />
  </div>

  <div class="flex gap-4" style="margin-top: 0.5rem;">
    <button type="submit" class="btn btn-primary" style="flex: 2; padding: 1rem;">
      <i data-lucide="printer"></i> Terbitkan & Cetak Surat Medis Resmi
    </button>
    <button type="button" class="btn btn-outline" style="flex: 1;" onclick="showTab('ruang_periksa')">
      Kembali ke SOAP
    </button>
  </div>
</form>

<!-- Modal Pop-up Cetak Surat Medis / Rujukan Resmi -->
<div class="modal-overlay" id="cert-modal-overlay">
  <div class="modal-card" style="max-width: 650px; padding: 2.25rem; background: #FFFFFF !important; color: #0F172A !important; border-radius: var(--radius-xl); box-shadow: 0 25px 50px rgba(0,0,0,0.5);">
    <div id="printable-cert-content">
      <!-- KOP Surat -->
      <div style="border-bottom: 2px solid #0F172A; padding-bottom: 0.75rem; margin-bottom: 1.25rem; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <div style="width: 44px; height: 44px; border-radius: 8px; background: #1E3926; color: #FFF; display: flex; align-items: center; justify-content: center; font-weight: 900;">
            <i data-lucide="cross" style="width: 24px; height: 24px;"></i>
          </div>
          <div>
            <h3 style="margin: 0; font-size: 1.1rem; color: #0F172A; font-weight: 900; letter-spacing: -0.01em;">KLINIK PRATAMA PUSDIKZI</h3>
            <p style="margin: 0; font-size: 0.75rem; font-weight: 700; color: #1E3926;">PUSAT PENDIDIKAN ZENI TNI ANGKATAN DARAT</p>
            <small style="color: #64748B; font-size: 0.7rem;">Jl. Jenderal Sudirman No. 35, Bogor Tengah • Telp: (0251) 832-1234</small>
          </div>
        </div>
        <div style="text-align: right;">
          <span style="background: #DCFCE7; color: #166534; font-size: 0.75rem; font-weight: 800; padding: 3px 8px; border-radius: 4px; font-family: monospace;" id="modal-cert-no">SURAT-20260830-001</span>
        </div>
      </div>

      <div style="text-align: center; margin-bottom: 1.25rem;">
        <h4 id="modal-cert-title" style="margin: 0; font-size: 1.15rem; font-weight: 900; text-decoration: underline; color: #0F172A; text-transform: uppercase;">SURAT KETERANGAN DOKTER</h4>
        <small style="color: #64748B; font-size: 0.75rem;">Standar Pelayanan Medis Terintegrasi SATUSEHAT Kemenkes RI</small>
      </div>

      <div id="modal-cert-body" style="font-size: 0.88rem; line-height: 1.7; margin-bottom: 1.5rem; color: #334155;">
        <p style="margin: 0 0 0.5rem 0;">Yang bertanda tangan di bawah ini Dokter Pemeriksa Klinik Pratama PUSDIKZI, menerangkan bahwa:</p>
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 0.75rem;">
          <div style="display: grid; grid-template-columns: 140px 1fr; gap: 0.25rem;">
            <span>Nama Pasien</span><strong>: Achmad Nurhadi</strong>
            <span>No. Rekam Medis</span><strong>: RM-2026-0881</strong>
            <span>Pangkat / Golongan</span><strong>: Anggota / BPJS Kesehatan</strong>
            <span>Diagnosa Medis</span><strong id="modal-cert-diag">: Febris H-2 ec Susp. Viral Infection</strong>
          </div>
        </div>
        <p id="modal-cert-desc" style="margin: 0;">Mengingat kondisi kesehatannya, pasien tersebut di atas memerlukan <strong>istirahat selama 2 (dua) hari</strong> terhitung mulai tanggal 30 Agustus 2026.</p>
      </div>

      <!-- Tanda Tangan Dokter -->
      <div style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid #E2E8F0; padding-top: 1rem; font-size: 0.82rem;">
        <div style="font-size: 0.75rem; color: #64748B;">
          <p style="margin: 0;">Surat ini sah diterbitkan secara elektronik.</p>
          <span style="font-family: monospace;">TTE SATUSEHAT: PZ-MED-VALID-2026</span>
        </div>
        <div style="text-align: center;">
          <p style="margin: 0 0 1.5rem 0; font-size: 0.78rem;">Bogor, 30 Agustus 2026<br/>Dokter Pemeriksa,</p>
          <strong style="color: #0F172A; display: block; border-bottom: 1px solid #0F172A;">dr. Agus Susanto, Sp.PD</strong>
          <small style="color: #64748B; font-size: 0.72rem;">SIP: 446.1/082/SIP-D/2024</small>
        </div>
      </div>
    </div>

    <div class="flex gap-2" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
      <button class="btn btn-primary btn-sm flex items-center justify-center gap-1" style="flex: 1;" onclick="window.print()">
        <i data-lucide="printer"></i> Cetak Surat Medis (Print / PDF)
      </button>
      <button class="btn btn-outline btn-sm" style="flex: 1;" onclick="document.getElementById('cert-modal-overlay').classList.remove('open')">
        Tutup
      </button>
    </div>
  </div>
</div>
