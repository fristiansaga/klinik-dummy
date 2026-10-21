<!-- Tabel Antrean Pasien Poli -->
<table class="table" style="width: 100%;">
  <thead>
    <tr>
      <th>No. Antrean</th>
      <th>Nama Pasien</th>
      <th>No. RM</th>
      <th>Penjamin</th>
      <th>Keluhan Utama</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr style="background: var(--primary-bg);">
      <td><span class="badge badge-primary" style="font-size: 0.9rem;">A-004</span></td>
      <td><strong>Achmad Nurhadi</strong><br/><small>Laki-laki • 36 Th</small></td>
      <td><strong>RM-2026-0881</strong></td>
      <td><span class="badge badge-success">BPJS Faskes 1</span></td>
      <td>Demam 2 hari, batuk kering, pusing</td>
      <td><span class="badge badge-warning">Sedang Diperiksa</span></td>
      <td>
        <button class="btn btn-primary btn-sm" onclick="showTab('soap_emr')">
          <i data-lucide="stethoscope" style="width: 14px;"></i> Buka SOAP
        </button>
      </td>
    </tr>
    <tr>
      <td><span class="badge badge-orange">A-005</span></td>
      <td><strong>Bambang Supriyanto</strong><br/><small>Laki-laki • 45 Th</small></td>
      <td><strong>RM-2026-0923</strong></td>
      <td><span class="badge badge-primary">Pasien Umum</span></td>
      <td>Nyeri dada kiri menjalar ke punggung</td>
      <td><span class="badge badge-orange">Menunggu (Urutan 2)</span></td>
      <td>
        <button class="btn btn-outline btn-sm" onclick="playAudioCall('A-005', 'Ruang Pemeriksaan Dokter 1')">
          <i data-lucide="volume-2" style="width: 14px;"></i> Panggil
        </button>
      </td>
    </tr>
  </tbody>
</table>
