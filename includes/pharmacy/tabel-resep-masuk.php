<!-- Tabel Antrean E-Resep Masuk dari Dokter -->
<table class="table" style="width: 100%;">
  <thead>
    <tr>
      <th>ID Resep</th>
      <th>Nama Pasien</th>
      <th>Poli / Dokter</th>
      <th>Rincian Obat</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>RX-0830-04</strong></td>
      <td><strong>Ibu Siti Aminah</strong><br/><small>RM-2026-0412</small></td>
      <td>Poli Penyakit Dalam<br/><small>dr. Agus Susanto, Sp.PD</small></td>
      <td>Glucosamine 500mg, Meloxicam 7.5mg, Metformin</td>
      <td><span class="badge badge-warning">Sedang Diracik</span></td>
      <td>
        <button class="btn btn-primary btn-sm" onclick="showToast('Obat selesai diracik!', 'success')">
          <i data-lucide="check" style="width: 14px;"></i> Selesai
        </button>
      </td>
    </tr>
    <tr>
      <td><strong>RX-0830-05</strong></td>
      <td><strong>Achmad Nurhadi</strong><br/><small>RM-2026-0881</small></td>
      <td>Poli Umum<br/><small>dr. Siti Rahmawati</small></td>
      <td>Amlodipine 10mg, Paracetamol 500mg, Vit B</td>
      <td><span class="badge badge-primary">Siap Diambil</span></td>
      <td>
        <div class="flex gap-1">
          <button class="btn btn-outline btn-sm" onclick="playAudioCall('F-022', 'Loket Apotek Farmasi')">
            <i data-lucide="volume-2" style="width: 14px;"></i> Panggil
          </button>
          <button class="btn btn-sm" style="background: #075E54; color: #FFF; border: none;" onclick="openWaSimulator('obat_siap')">
            <i data-lucide="message-circle" style="width: 14px;"></i> WA
          </button>
        </div>
      </td>
    </tr>
    <tr>
      <td><strong>RX-0830-06</strong></td>
      <td><strong>Bambang Supriyanto</strong><br/><small>RM-2026-0923</small></td>
      <td>Poli Umum<br/><small>dr. Siti Rahmawati</small></td>
      <td>Ambroxol syr, Cefixime 100mg, Dexamethasone</td>
      <td><span class="badge badge-orange">Antre Racik</span></td>
      <td>
        <button class="btn btn-primary btn-sm" onclick="showToast('Mulai proses peracikan!')">Racik</button>
      </td>
    </tr>
  </tbody>
</table>
