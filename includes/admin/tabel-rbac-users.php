<!-- Tabel Manajemen Pengguna & Hak Akses (RBAC) -->
<table class="table" style="width: 100%;">
  <thead>
    <tr>
      <th>Nama Lengkap Staf</th>
      <th>Username</th>
      <th>Peran / Role (RBAC)</th>
      <th>Akses Modul</th>
      <th>Status Akun</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Administrator IT</strong></td>
      <td><code>admin_pusdikzi</code></td>
      <td><span class="badge badge-danger">Super Admin</span></td>
      <td>Seluruh Modul (Full Access)</td>
      <td><span class="badge badge-success">Aktif</span></td>
      <td>
        <button class="btn btn-outline btn-sm" onclick="showToast('Edit Pengguna')">Edit</button>
      </td>
    </tr>
    <tr>
      <td><strong>dr. Agus Susanto, Sp.PD</strong></td>
      <td><code>dokter_agus</code></td>
      <td><span class="badge badge-warning">Dokter Spesialis</span></td>
      <td>EMR SOAP, POCT Lab, Resep, Surat Medis</td>
      <td><span class="badge badge-success">Aktif</span></td>
      <td>
        <button class="btn btn-outline btn-sm" onclick="showToast('Edit Pengguna')">Edit</button>
      </td>
    </tr>
    <tr>
      <td><strong>apt. Nurul Hidayah, S.Farm</strong></td>
      <td><code>apotek_farmasi</code></td>
      <td><span class="badge badge-success">Apoteker</span></td>
      <td>Dispensing Obat, Stock Opname FEFO</td>
      <td><span class="badge badge-success">Aktif</span></td>
      <td>
        <button class="btn btn-outline btn-sm" onclick="showToast('Edit Pengguna')">Edit</button>
      </td>
    </tr>
    <tr>
      <td><strong>Serka M. Yusuf</strong></td>
      <td><code>kasir_billing</code></td>
      <td><span class="badge badge-orange">Kasir Keuangan</span></td>
      <td>Smart Billing, Kuitansi BPJS, Kas</td>
      <td><span class="badge badge-success">Aktif</span></td>
      <td>
        <button class="btn btn-outline btn-sm" onclick="showToast('Edit Pengguna')">Edit</button>
      </td>
    </tr>
  </tbody>
</table>
