<!-- Tabel Status Integrasi & Log Audit Keamanan SATUSEHAT -->
<div class="grid grid-cols-3 gap-4" style="margin-bottom: 1.5rem;">
  <div class="card" style="padding: 1.25rem; background: #DCFCE7; color: #166534;">
    <span style="font-size: 0.8rem; font-weight: 700;">STATUS SATUSEHAT FHIR API</span>
    <h3 style="font-size: 1.4rem; margin: 0.25rem 0;">TERHUBUNG (200 OK)</h3>
    <small>Organization ID: 100028491 (Kemenkes)</small>
  </div>
  <div class="card" style="padding: 1.25rem; background: var(--primary-bg); color: var(--primary);">
    <span style="font-size: 0.8rem; font-weight: 700;">BRIDGING P-CARE BPJS</span>
    <h3 style="font-size: 1.4rem; margin: 0.25rem 0;">AKTIF (KBKP 100%)</h3>
    <small>Kode Faskes: 0118B001 (FKTP Pusdikzi)</small>
  </div>
  <div class="card" style="padding: 1.25rem; background: #FEF3C7; color: #92400E;">
    <span style="font-size: 0.8rem; font-weight: 700;">LOG RME ENCRYPTED</span>
    <h3 style="font-size: 1.4rem; margin: 0.25rem 0;">AES-256 BIT</h3>
    <small>Kepatuhan UU PDP & Permenkes 24/2022</small>
  </div>
</div>

<table class="table" style="width: 100%;">
  <thead>
    <tr>
      <th>Timestamp Log</th>
      <th>Aktor / Staf Medis</th>
      <th>Aktivitas Sistem</th>
      <th>Endpoint API / FHIR Resource</th>
      <th>Status Respon</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>30/08/2026 09:42:15</td>
      <td>dr. Agus Susanto, Sp.PD</td>
      <td>Kirim EMR SOAP (Encounter & Condition)</td>
      <td><code>POST /fhir-r4/v1/Encounter</code></td>
      <td><span class="badge badge-success">201 Created</span></td>
    </tr>
    <tr>
      <td>30/08/2026 09:45:00</td>
      <td>apt. Nurul Hidayah, S.Farm</td>
      <td>Dispensing Obat (MedicationDispense)</td>
      <td><code>POST /fhir-r4/v1/MedicationDispense</code></td>
      <td><span class="badge badge-success">201 Created</span></td>
    </tr>
  </tbody>
</table>
