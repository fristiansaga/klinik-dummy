<!-- Modal Overlay Struk Kuitansi & Bukti BPJS Bebas Biaya -->
<div class="modal-overlay" id="receipt-modal-overlay">
  <div class="modal-card" style="max-width: 520px; padding: 2rem; border-radius: var(--radius-xl); background: #FFFFFF !important; color: #0F172A !important; box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
    <div id="printable-receipt-content">
      <div style="text-align: center; border-bottom: 2px dashed var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
        <div style="font-weight: 800; font-size: 1.1rem; color: var(--primary);">KODIKLAT TNI-AD • KLINIK PRATAMA PUSDIKZI</div>
        <p style="font-size: 0.8rem; color: var(--text-light); margin: 0.2rem 0;">Jl. Jenderal Sudirman No. 45, Bogor • Telp: (0251) 832-1234</p>
        <span class="badge" id="rec-header-badge" style="background: var(--primary-bg); color: var(--primary); font-size: 0.8rem; font-weight: 700;">
          BUKTI TRANSAKSI & PELAYANAN MEDIS
        </span>
      </div>

      <div id="receipt-body" style="font-size: 0.85rem; line-height: 1.6; margin-bottom: 1rem;">
        <div class="flex justify-between"><span>No. Bukti Transaksi:</span><strong id="rec-trx-no">TRX-20260830-008</strong></div>
        <div class="flex justify-between"><span>Nama Pasien:</span><strong id="rec-nama">Hendra Kusuma</strong></div>
        <div class="flex justify-between"><span>No. Rekam Medis:</span><strong id="rec-rm">RM-2026-0551</strong></div>
        <div class="flex justify-between"><span>Jenis Penjamin:</span><strong id="rec-penjamin" style="color: var(--primary);">Umum / Tunai</strong></div>
        <div class="flex justify-between"><span>Tanggal / Waktu:</span><span>30 Agu 2026, 09:45 WIB</span></div>
        
        <hr style="border: none; border-top: 1px solid var(--border-color); margin: 0.75rem 0;" />
        
        <!-- Itemized Breakdown -->
        <div id="rec-items-list">
          <div class="flex justify-between"><span>Konsultasi & Pemeriksaan Dokter</span><span>Rp 75.000</span></div>
          <div class="flex justify-between"><span>Tindakan Medis / POCT Lab</span><span>Rp 50.000</span></div>
          <div class="flex justify-between"><span>Paket Resep Obat & Farmasi</span><span>Rp 50.000</span></div>
        </div>

        <hr style="border: none; border-top: 1px solid var(--border-color); margin: 0.75rem 0;" />

        <div class="flex justify-between" style="font-size: 0.9rem;">
          <span>Subtotal Tarif Pelayanan:</span>
          <span id="rec-subtotal" style="font-weight: 600;">Rp 175.000</span>
        </div>
        
        <div id="rec-bpjs-cover-row" class="flex justify-between" style="font-size: 0.9rem; color: var(--success); display: none;">
          <span>Ditanggung BPJS Kesehatan (100%):</span>
          <span id="rec-bpjs-cover-val">-Rp 175.000</span>
        </div>

        <hr style="border: none; border-top: 2px solid var(--border-color); margin: 0.5rem 0;" />

        <div class="flex justify-between items-center" style="font-size: 1.25rem; font-weight: 800; padding: 0.4rem 0;">
          <span>IUR BIAYA PASIEN:</span>
          <span id="rec-total" style="color: var(--primary);">Rp 275.000</span>
        </div>

        <div id="rec-bpjs-note" style="display: none; background: #DCFCE7; padding: 0.6rem 0.8rem; border-radius: 6px; font-size: 0.75rem; color: #166534; margin-top: 0.5rem; text-align: center;">
          ✓ Pelayanan ini <strong>BEBAS BIAYA 100%</strong> sesuai program Jaminan Kesehatan Nasional (JKN/BPJS FKTP). Tagihan dibebankan ke Dana Kapitasi/Klaim Faskes 1.
        </div>
      </div>

      <div style="text-align: center; font-size: 0.75rem; color: var(--text-muted); border-top: 1px solid var(--border-color); padding-top: 0.75rem;">
        Semoga Lekas Sembuh • Bukti sah terdaftar di P-Care BPJS & SATUSEHAT Kemenkes RI.
      </div>
    </div>

    <div class="flex gap-2" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
      <button class="btn btn-primary btn-sm flex items-center justify-center gap-1" style="flex: 1;" onclick="window.print()">
        <i data-lucide="printer"></i> Cetak Bukti Struk
      </button>
      <button class="btn btn-outline btn-sm" style="flex: 1;" onclick="document.getElementById('receipt-modal-overlay').classList.remove('open')">
        Tutup
      </button>
    </div>
  </div>
</div>
