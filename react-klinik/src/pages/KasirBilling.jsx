import React, { useState } from 'react';
import { LayoutDashboard, Receipt, BarChart3, CreditCard, Printer, CheckCircle2, QrCode, X } from 'lucide-react';
import Sidebar from '../components/Sidebar';
import { useClinic } from '../context/ClinicContext';

export default function KasirBilling() {
  const [activeTab, setActiveTab] = useState('beranda_kasir');
  const [receiptModal, setReceiptModal] = useState(null);
  const { showToast } = useClinic();

  const user = {
    name: 'Serka M. Yusuf',
    role: 'Kasir & Keuangan',
    initials: 'MY',
    avatarBg: 'bg-orange-600',
    badgeClass: 'bg-orange-500/20 text-orange-400'
  };

  const menuItems = [
    { id: 'beranda_kasir', label: 'Dashboard Kasir', icon: LayoutDashboard },
    { id: 'antrean_bayar', label: 'Antrean Billing Pasien', icon: Receipt },
    { id: 'rekap_kas', label: 'Rekapitulasi Kas Harian', icon: BarChart3 }
  ];

  const billingQueue = [
    { id: 'INV-001', name: 'Bapak Hendra Kusuma', rm: 'RM-2026-0551', poli: 'Poli Gigi', penjamin: 'Umum / Mandiri', items: 'Penambalan Gigi Komposit Sinar + Resep Analgesik', total: 275000 },
    { id: 'INV-002', name: 'Ibu Siti Aminah', rm: 'RM-2026-0923', poli: 'Poli Penyakit Dalam', penjamin: 'BPJS Kesehatan', items: 'Konsultasi Spesialis + Glukosa Darah POCT + Resep Metformin', total: 0 },
    { id: 'INV-003', name: 'Kopda Bambang Trihatmojo', rm: 'RM-2026-0042', poli: 'Poli Umum', penjamin: 'Dinas TNI-AD', items: 'MCU Kesiapan Tugas + Surat Bebas Narkoba', total: 0 }
  ];

  const handleOpenReceipt = (item) => {
    setReceiptModal(item);
  };

  return (
    <div className="flex flex-col md:flex-row gap-6 py-6">
      <Sidebar user={user} menuItems={menuItems} activeTab={activeTab} setActiveTab={setActiveTab} />

      <main className="flex-1 space-y-6">
        
        {/* Tab 1: Dashboard Kasir */}
        {activeTab === 'beranda_kasir' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Kasir & Smart Billing 💳</h2>
                <p className="text-xs text-slate-400">Kelola pembayaran tunai, QRIS dinamis, dan kuitansi klaim BPJS Kesehatan.</p>
              </div>
              <button
                onClick={() => setActiveTab('antrean_bayar')}
                className="flex items-center gap-2 text-xs font-bold bg-orange-700 hover:bg-orange-600 text-white px-4 py-2.5 rounded-xl transition"
              >
                <Receipt className="w-4 h-4" /> Lihat Antrean Tagihan
              </button>
            </div>

            {/* Ready Bill Highlight */}
            <div className="glass-panel p-6 rounded-2xl border-l-4 border-l-orange-500 border border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
              <div>
                <span className="text-[10px] font-bold px-2.5 py-1 bg-orange-500/20 text-orange-400 rounded-full">
                  TAGIHAN SIAP DIPROSES
                </span>
                <h3 className="text-base font-bold text-white mt-2">B-008: Bapak Hendra Kusuma (Umum)</h3>
                <p className="text-xs text-slate-400">Poli Gigi (Penambalan Gigi Komposit + Resep) • Total: <strong className="text-orange-400 font-mono">Rp 275.000</strong></p>
              </div>

              <button
                onClick={() => handleOpenReceipt(billingQueue[0])}
                className="flex items-center gap-2 text-xs font-bold bg-emerald-700 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl shadow-glow-primary transition"
              >
                <CreditCard className="w-4 h-4" /> Proses Pembayaran
              </button>
            </div>
          </div>
        )}

        {/* Tab 2: Antrean Billing Pasien */}
        {activeTab === 'antrean_bayar' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Daftar Antrean Billing Pasien 🧾</h2>
              <p className="text-xs text-slate-400">Daftar tagihan yang telah selesai dari ruang periksa dokter & apotek.</p>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 overflow-x-auto">
              <table className="w-full text-xs text-left">
                <thead>
                  <tr className="border-b border-slate-800 text-slate-400">
                    <th className="pb-3">No. Invoice</th>
                    <th className="pb-3">Pasien</th>
                    <th className="pb-3">Poliklinik</th>
                    <th className="pb-3">Penjamin</th>
                    <th className="pb-3">Total Biaya</th>
                    <th className="pb-3 text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-800/60">
                  {billingQueue.map((item, idx) => (
                    <tr key={idx} className="hover:bg-slate-900/60 transition">
                      <td className="py-3 font-mono font-bold text-orange-400">{item.id}</td>
                      <td className="py-3 font-semibold text-white">
                        {item.name}
                        <small className="block text-slate-500">{item.rm}</small>
                      </td>
                      <td className="py-3 text-slate-300">{item.poli}</td>
                      <td className="py-3">
                        <span className={`text-[10px] font-bold px-2 py-0.5 rounded ${
                          item.penjamin.includes('BPJS') ? 'bg-emerald-500/20 text-emerald-400' : 'bg-slate-800 text-slate-300'
                        }`}>
                          {item.penjamin}
                        </span>
                      </td>
                      <td className="py-3 font-mono font-bold text-white">
                        {item.total === 0 ? <span className="text-emerald-400">Rp 0 (BPJS Free)</span> : `Rp ${item.total.toLocaleString('id-ID')}`}
                      </td>
                      <td className="py-3 text-right">
                        <button
                          onClick={() => handleOpenReceipt(item)}
                          className="bg-emerald-700 hover:bg-emerald-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition"
                        >
                          Cetak Struk
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {/* Tab 3: Rekap Kas */}
        {activeTab === 'rekap_kas' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Rekapitulasi Kas Harian 📊</h2>
                <p className="text-xs text-slate-400">Laporan arus kas dan rincian transaksi billing klinik.</p>
              </div>
              <button onClick={() => window.print()} className="flex items-center gap-1.5 text-xs bg-slate-900 border border-slate-700 text-slate-200 px-3.5 py-2 rounded-xl">
                <Printer className="w-3.5 h-3.5" /> Ekspor PDF Laporan Kas
              </button>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div className="glass-panel p-5 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[11px] font-bold text-emerald-400">TOTAL PENERIMAAN TUNAI & QRIS</span>
                <div className="text-2xl font-bold font-mono text-white">Rp 2.450.000</div>
                <small className="text-[10px] text-slate-500">14 Pasien Umum</small>
              </div>
              <div className="glass-panel p-5 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[11px] font-bold text-sky-400">KLAIM BPJS KESEHATAN (KAPITASI)</span>
                <div className="text-2xl font-bold font-mono text-white">Rp 4.800.000</div>
                <small className="text-[10px] text-slate-500">32 Pasien Terlayani</small>
              </div>
              <div className="glass-panel p-5 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[11px] font-bold text-orange-400">TOTAL TRANSAKSI HARI INI</span>
                <div className="text-2xl font-bold font-mono text-white">46 Pasien</div>
                <small className="text-[10px] text-slate-500">Status Kas Seimbang (Match 100%)</small>
              </div>
            </div>
          </div>
        )}

      </main>

      {/* Modal Receipt / Struk */}
      {receiptModal && (
        <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
          <div className="w-full max-w-md bg-white text-slate-950 rounded-3xl p-6 space-y-4 shadow-2xl animate-in zoom-in-95">
            <div className="flex items-center justify-between border-b pb-3">
              <div>
                <h4 className="font-extrabold text-sm text-emerald-900">KLINIK PRATAMA PUSDIKZI</h4>
                <p className="text-[10px] text-slate-500">KODIKLAT TNI-AD • BOGOR</p>
              </div>
              <button onClick={() => setReceiptModal(null)} className="text-slate-400 hover:text-slate-700">
                <X className="w-5 h-5" />
              </button>
            </div>

            <div className="text-center py-2 bg-slate-50 rounded-xl">
              <span className={`text-[10px] font-bold px-2.5 py-1 rounded-full ${
                receiptModal.total === 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-800'
              }`}>
                {receiptModal.total === 0 ? 'BUKTI PELAYANAN BPJS KESEHATAN' : 'BUKTI PEMBAYARAN KUITANSI'}
              </span>
            </div>

            <div className="space-y-1.5 text-xs">
              <div className="flex justify-between"><span className="text-slate-500">Nama Pasien:</span><strong>{receiptModal.name}</strong></div>
              <div className="flex justify-between"><span className="text-slate-500">No. Rekam Medis:</span><strong className="font-mono">{receiptModal.rm}</strong></div>
              <div className="flex justify-between"><span className="text-slate-500">Penjamin:</span><strong>{receiptModal.penjamin}</strong></div>
              <div className="flex justify-between border-t pt-2"><span className="text-slate-500">Rincian:</span><span className="text-right text-[11px] max-w-[200px]">{receiptModal.items}</span></div>
            </div>

            <div className="border-t-2 border-dashed pt-3 flex justify-between items-center text-sm font-extrabold">
              <span>TOTAL PEMBAYARAN:</span>
              <span className={`font-mono ${receiptModal.total === 0 ? 'text-emerald-700' : 'text-slate-950'}`}>
                {receiptModal.total === 0 ? 'Rp 0 (BEBAS BIAYA)' : `Rp ${receiptModal.total.toLocaleString('id-ID')}`}
              </span>
            </div>

            <div className="flex gap-2 pt-2">
              <button
                onClick={() => {
                  window.print();
                  setReceiptModal(null);
                }}
                className="flex-1 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold py-2.5 rounded-xl transition flex items-center justify-center gap-1.5"
              >
                <Printer className="w-4 h-4" /> Cetak Kuitansi
              </button>
            </div>
          </div>
        </div>
      )}

    </div>
  );
}
