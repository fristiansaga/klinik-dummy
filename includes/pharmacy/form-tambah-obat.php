<!-- Form Registrasi Master Obat & Log Penerimaan Inbound -->
<form onsubmit="handleSaveMedicine(event)" style="display: flex; flex-direction: column; gap: 1.25rem;">
  <div class="grid grid-cols-2 gap-4">
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Kode Obat / SKU *</label>
      <input type="text" class="form-control" placeholder="Misal: OBT-006" required />
    </div>
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Kategori Farmasi *</label>
      <select class="form-control" required>
        <option value="Tablet">Tablet / Kapsul</option>
        <option value="Sirup">Sirup / Suspensi</option>
        <option value="Injeksi">Injeksi / Ampul</option>
        <option value="Salep">Salep / Krim</option>
        <option value="Alkes">Alat Kesehatan & Habis Pakai</option>
      </select>
    </div>
  </div>

  <div class="form-group" style="margin: 0;">
    <label class="form-label" style="font-weight: 600;">Nama Obat & Dosis Lengkap *</label>
    <input type="text" class="form-control" placeholder="Misal: Ibuprofen 400mg" required />
  </div>

  <div class="grid grid-cols-3 gap-4">
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Jumlah Diterima (Qty) *</label>
      <input type="number" class="form-control" placeholder="100" required />
    </div>
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Batas Minimum Stok *</label>
      <input type="number" class="form-control" placeholder="20" required />
    </div>
    <div class="form-group" style="margin: 0;">
      <label class="form-label" style="font-weight: 600;">Harga Satuan (Rp) *</label>
      <input type="number" class="form-control" placeholder="5000" required />
    </div>
  </div>

  <!-- Batch & Inbound Detail -->
  <div class="card" style="padding: 1.25rem; background: var(--primary-bg); margin: 0.5rem 0;">
    <h4 style="color: var(--primary); font-size: 0.95rem; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
      <i data-lucide="tag"></i> Informasi Batch & Log Penerimaan (Inbound)
    </h4>
    <div class="grid grid-cols-3 gap-3">
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-size: 0.8rem; font-weight: 600;">Nomor Batch Pabrik *</label>
        <input type="text" class="form-control" placeholder="BATCH-2026-X" required />
      </div>
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-size: 0.8rem; font-weight: 600;">Tanggal Masuk (Inbound)</label>
        <input type="date" class="form-control" value="2026-08-30" required />
      </div>
      <div class="form-group" style="margin: 0;">
        <label class="form-label" style="font-size: 0.8rem; font-weight: 600;">Tanggal Kadaluarsa (ED) *</label>
        <input type="date" class="form-control" value="2028-12-31" required />
      </div>
    </div>
    <div class="form-group" style="margin-top: 0.75rem; margin-bottom: 0;">
      <label class="form-label" style="font-size: 0.8rem; font-weight: 600;">Nama PBF / Distributor Supplier</label>
      <input type="text" class="form-control" placeholder="Misal: PT Kimia Farma Trading & Distribution" />
    </div>
  </div>

  <div class="flex gap-4" style="margin-top: 0.5rem;">
    <button type="submit" class="btn btn-primary" style="flex: 1; padding: 0.9rem;">
      <i data-lucide="check"></i> Simpan Master & Log Batch Masuk
    </button>
    <button type="button" class="btn btn-outline" style="flex: 1; padding: 0.9rem;" onclick="showTab('stock_opname')">
      Batal
    </button>
  </div>
</form>
