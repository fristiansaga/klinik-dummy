<!-- Tabel Stock Opname & Pelacak Batch FEFO (Tunggal Tombol Edit di Atas) -->
<table class="table" style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
  <thead>
    <tr>
      <th>Nama Obat & Pabrik</th>
      <th>No. Batch</th>
      <th>Tgl Masuk</th>
      <th>Kadaluarsa (ED)</th>
      <th>Sisa Hari</th>
      <th>Stok Sistem</th>
      <th style="text-align: center; width: 175px;">Fisik Nyata (+ / -)</th>
      <th style="text-align: center;">Selisih</th>
      <th>Status & Prioritas FEFO</th>
    </tr>
  </thead>
  <tbody>
    <!-- Row 1: Kritis -->
    <tr style="background: #FFF5F5;" id="row-opname-1">
      <td><strong>Paracetamol Drop 15ml</strong><br/><small>PT Kimia Farma</small></td>
      <td><code>BATCH-PCT-089</code></td>
      <td>15 Sep 2024</td>
      <td><strong style="color: var(--danger);">18 Sep 2026</strong></td>
      <td><span class="badge badge-danger">19 Hari</span></td>
      <td><strong>25</strong> Btl</td>
      <td style="text-align: center;">
        <div class="opname-stepper" id="stepper-1">
          <button type="button" class="opname-btn" onclick="stepOpname(1, -1, 25)" disabled title="Kurangi">-</button>
          <input type="number" class="opname-input" id="input-opname-1" value="25" disabled oninput="calculateSelisih(1, 25)" />
          <button type="button" class="opname-btn" onclick="stepOpname(1, 1, 25)" disabled title="Tambah">+</button>
        </div>
      </td>
      <td style="text-align: center;"><span class="selisih-val" id="selisih-1" style="font-weight: 800; font-size: 1.1rem; color: var(--success);">0</span></td>
      <td><span class="badge badge-danger">Karantina / Tarik</span></td>
    </tr>

    <!-- Row 2: Waspada FEFO 1 -->
    <tr style="background: #FFFBEB;" id="row-opname-2">
      <td><strong>Amlodipine 10mg</strong><br/><small>PT Dexa Medica</small></td>
      <td><code>BATCH-AML-201</code></td>
      <td>10 Jan 2025</td>
      <td><strong style="color: var(--warning);">25 Nov 2026</strong></td>
      <td><span class="badge badge-warning">86 Hari</span></td>
      <td><strong>18</strong> Tab</td>
      <td style="text-align: center;">
        <div class="opname-stepper" id="stepper-2">
          <button type="button" class="opname-btn" onclick="stepOpname(2, -1, 18)" disabled title="Kurangi">-</button>
          <input type="number" class="opname-input" id="input-opname-2" value="18" disabled oninput="calculateSelisih(2, 18)" />
          <button type="button" class="opname-btn" onclick="stepOpname(2, 1, 18)" disabled title="Tambah">+</button>
        </div>
      </td>
      <td style="text-align: center;"><span class="selisih-val" id="selisih-2" style="font-weight: 800; font-size: 1.1rem; color: var(--success);">0</span></td>
      <td><span class="badge badge-warning">⭐ Prioritas 1 FEFO</span></td>
    </tr>

    <!-- Row 3: Waspada FEFO 2 -->
    <tr style="background: #FFFBEB;" id="row-opname-3">
      <td><strong>Antasida Doen Suspensi</strong><br/><small>PT Sanbe Farma</small></td>
      <td><code>BATCH-ANT-104</code></td>
      <td>05 Feb 2025</td>
      <td><strong style="color: var(--warning);">15 Des 2026</strong></td>
      <td><span class="badge badge-warning">106 Hari</span></td>
      <td><strong>12</strong> Btl</td>
      <td style="text-align: center;">
        <div class="opname-stepper" id="stepper-3">
          <button type="button" class="opname-btn" onclick="stepOpname(3, -1, 12)" disabled title="Kurangi">-</button>
          <input type="number" class="opname-input" id="input-opname-3" value="12" disabled oninput="calculateSelisih(3, 12)" />
          <button type="button" class="opname-btn" onclick="stepOpname(3, 1, 12)" disabled title="Tambah">+</button>
        </div>
      </td>
      <td style="text-align: center;"><span class="selisih-val" id="selisih-3" style="font-weight: 800; font-size: 1.1rem; color: var(--success);">0</span></td>
      <td><span class="badge badge-warning">⭐ Prioritas 2 FEFO</span></td>
    </tr>

    <!-- Row 4: Aman -->
    <tr id="row-opname-4">
      <td><strong>Amoxicillin 500mg</strong><br/><small>PT Kalbe Farma</small></td>
      <td><code>BATCH-AMX-771</code></td>
      <td>20 Mei 2026</td>
      <td><strong>15 Agu 2028</strong></td>
      <td><span class="badge badge-success">715 Hari</span></td>
      <td><strong>420</strong> Kap</td>
      <td style="text-align: center;">
        <div class="opname-stepper" id="stepper-4">
          <button type="button" class="opname-btn" onclick="stepOpname(4, -1, 420)" disabled title="Kurangi">-</button>
          <input type="number" class="opname-input" id="input-opname-4" value="420" disabled oninput="calculateSelisih(4, 420)" />
          <button type="button" class="opname-btn" onclick="stepOpname(4, 1, 420)" disabled title="Tambah">+</button>
        </div>
      </td>
      <td style="text-align: center;"><span class="selisih-val" id="selisih-4" style="font-weight: 800; font-size: 1.1rem; color: var(--success);">0</span></td>
      <td><span class="badge badge-primary">FEFO Prioritas 3</span></td>
    </tr>

    <!-- Row 5: Aman -->
    <tr id="row-opname-5">
      <td><strong>Metformin 500mg</strong><br/><small>PT Bernofarm</small></td>
      <td><code>BATCH-MET-332</code></td>
      <td>12 Jun 2026</td>
      <td><strong>30 Des 2028</strong></td>
      <td><span class="badge badge-success">852 Hari</span></td>
      <td><strong>310</strong> Tab</td>
      <td style="text-align: center;">
        <div class="opname-stepper" id="stepper-5">
          <button type="button" class="opname-btn" onclick="stepOpname(5, -1, 310)" disabled title="Kurangi">-</button>
          <input type="number" class="opname-input" id="input-opname-5" value="310" disabled oninput="calculateSelisih(5, 310)" />
          <button type="button" class="opname-btn" onclick="stepOpname(5, 1, 310)" disabled title="Tambah">+</button>
        </div>
      </td>
      <td style="text-align: center;"><span class="selisih-val" id="selisih-5" style="font-weight: 800; font-size: 1.1rem; color: var(--success);">0</span></td>
      <td><span class="badge badge-primary">FEFO Prioritas 4</span></td>
    </tr>
  </tbody>
</table>
