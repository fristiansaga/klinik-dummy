<!-- Tabel Antrean Tagihan Kasir Pasien -->
<table class="table" style="width: 100%;">
  <thead>
    <tr>
      <th>No. Invoice</th>
      <th>Nama Pasien</th>
      <th>Layanan Poli</th>
      <th>Penjamin</th>
      <th>Total Tagihan</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr style="background: var(--primary-bg);">
      <td><strong>INV-0830-01</strong></td>
      <td><strong>Hendra Kusuma</strong><br/><small>RM-2026-0551</small></td>
      <td>Poli Gigi (Tambal Gigi)</td>
      <td><span class="badge badge-primary">Umum Mandiri</span></td>
      <td><strong style="color: var(--primary);">Rp 275.000</strong></td>
      <td><span class="badge badge-warning">Belum Bayar</span></td>
      <td>
        <button class="btn btn-primary btn-sm flex items-center gap-1" onclick="openReceiptModal('Hendra Kusuma', 'RM-2026-0551', 'Umum Mandiri', 275000)">
          <i data-lucide="credit-card" style="width: 14px;"></i> Bayar
        </button>
      </td>
    </tr>
    <tr>
      <td><strong>INV-0830-02</strong></td>
      <td><strong>Ibu Siti Aminah</strong><br/><small>RM-2026-0412</small></td>
      <td>Poli Penyakit Dalam</td>
      <td><span class="badge badge-success">BPJS Cover 100%</span></td>
      <td><strong>Rp 0 (Klaim BPJS)</strong></td>
      <td><span class="badge badge-success">Lunas Klaim</span></td>
      <td>
        <button class="btn btn-outline btn-sm" onclick="openReceiptModal('Ibu Siti Aminah', 'RM-2026-0412', 'BPJS Kesehatan', 0)">
          <i data-lucide="printer" style="width: 14px;"></i> Struk
        </button>
      </td>
    </tr>
  </tbody>
</table>
