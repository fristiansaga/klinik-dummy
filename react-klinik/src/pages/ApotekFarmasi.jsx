import React, { useState } from 'react';
import { LayoutDashboard, FileText, Package, ClipboardCheck, PlusCircle, CheckCircle2, AlertTriangle, AlertOctagon, Printer, Save } from 'lucide-react';
import Sidebar from '../components/Sidebar';
import { useClinic } from '../context/ClinicContext';

export default function ApotekFarmasi() {
  const [activeTab, setActiveTab] = useState('beranda');
  const { medicines, setMedicines, showToast, openWaSimulator } = useClinic();
  
  // New Medicine Form State
  const [medName, setMedName] = useState('');
  const [medBatch, setMedBatch] = useState('');
  const [medStock, setMedStock] = useState(100);
  const [medExpiry, setMedExpiry] = useState('2028-12-31');

  const user = {
    name: 'apt. Nurul Hidayah, S.Farm',
    role: 'Kepala Instalasi Farmasi',
    initials: 'NH',
    avatarBg: 'bg-teal-600',
    badgeClass: 'bg-teal-500/20 text-teal-400'
  };

  const menuItems = [
    { id: 'beranda', label: 'Dashboard Farmasi', icon: LayoutDashboard },
    { id: 'resep_masuk', label: 'Antrean E-Resep Masuk', icon: FileText },
    { id: 'stok_obat', label: 'Manajemen Stok Obat', icon: Package },
    { id: 'stock_opname', label: 'Stock Opname & FEFO', icon: ClipboardCheck },
    { id: 'tambah_obat', label: 'Tambah Master Obat', icon: PlusCircle }
  ];

  const handleAddMed = (e) => {
    e.preventDefault();
    const newMed = {
      id: medicines.length + 1,
      name: medName,
      batch: medBatch || `BCH-${Math.floor(1000 + Math.random() * 9000)}`,
      inbound: new Date().toISOString().split('T')[0],
      expiry: medExpiry,
      stock: parseInt(medStock),
      min: 30,
      price: 15000,
      status: 'Aman',
      cat: 'Obat Bebas'
    };
    setMedicines([...medicines, newMed]);
    showToast(`Obat ${medName} Berhasil Didaftarkan!`, 'success');
    setActiveTab('stok_obat');
  };

  return (
    <div className="flex flex-col md:flex-row gap-6 py-6">
      <Sidebar user={user} menuItems={menuItems} activeTab={activeTab} setActiveTab={setActiveTab} />

      <main className="flex-1 space-y-6">
        
        {/* Tab 1: Dashboard Farmasi */}
        {activeTab === 'beranda' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Dashboard Instalasi Farmasi 💊</h2>
                <p className="text-xs text-slate-400">Monitoring dispensing e-resep dan ketersediaan stok obat FEFO.</p>
              </div>
              <button
                onClick={() => setActiveTab('resep_masuk')}
                className="flex items-center gap-2 text-xs font-bold bg-teal-700 hover:bg-teal-600 text-white px-4 py-2.5 rounded-xl transition"
              >
                <FileText className="w-4 h-4" /> Lihat Resep Masuk
              </button>
            </div>

            {/* Quick KPI Stats */}
            <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-emerald-400">RESEP SELESAI HARI INI</span>
                <div className="text-2xl font-extrabold text-white font-mono">24</div>
                <small className="text-[10px] text-slate-400">Rata-rata 4.5 menit/resep</small>
              </div>
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-amber-400">MENUNGGU DIRACIK</span>
                <div className="text-2xl font-extrabold text-white font-mono">3</div>
                <small className="text-[10px] text-slate-400">Prioritas Poli Spesialis</small>
              </div>
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-rose-400">STOK KRITIS</span>
                <div className="text-2xl font-extrabold text-white font-mono">2</div>
                <small className="text-[10px] text-slate-400">Segera ajukan PO</small>
              </div>
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-orange-400">FEFO &lt; 90 HARI</span>
                <div className="text-2xl font-extrabold text-white font-mono">3 Batch</div>
                <small className="text-[10px] text-slate-400">Prioritas keluar pertama</small>
              </div>
            </div>
          </div>
        )}

        {/* Tab 2: Resep Masuk */}
        {activeTab === 'resep_masuk' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Antrean E-Resep Masuk 📄</h2>
              <p className="text-xs text-slate-400">Resep langsung terkirim dari ruang periksa dokter.</p>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 space-y-4">
              <div className="p-4 rounded-2xl bg-slate-900 border border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                  <div className="flex items-center gap-2">
                    <span className="font-mono text-sm font-bold text-emerald-400">RX-2026-0092</span>
                    <span className="text-[10px] font-bold px-2 py-0.5 bg-amber-500/20 text-amber-400 rounded">Menunggu Racik</span>
                  </div>
                  <h4 className="text-sm font-bold text-white mt-1">Bapak Achmad Nurhadi (RM-2026-0881)</h4>
                  <p className="text-xs text-slate-400">Amlodipine 10mg (30 Tab) • dr. Agus Susanto, Sp.PD</p>
                </div>

                <div className="flex gap-2">
                  <button
                    onClick={() => {
                      showToast("Resep Selesai Diracik & Pasien Dinotifikasi via WhatsApp!", "success");
                      openWaSimulator('obat');
                    }}
                    className="flex items-center gap-1.5 text-xs font-bold bg-teal-700 hover:bg-teal-600 text-white px-4 py-2 rounded-xl transition"
                  >
                    <CheckCircle2 className="w-4 h-4" /> Tandai Selesai
                  </button>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* Tab 3: Stok Obat */}
        {activeTab === 'stok_obat' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Inventori & Master Obat Farmasi 📦</h2>
                <p className="text-xs text-slate-400">Monitoring stok fisik, batas minimum, dan nomor batch pabrik.</p>
              </div>
              <button
                onClick={() => setActiveTab('tambah_obat')}
                className="flex items-center gap-1.5 text-xs font-bold bg-emerald-700 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl transition"
              >
                <PlusCircle className="w-4 h-4" /> Tambah Obat Baru
              </button>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 overflow-x-auto">
              <table className="w-full text-xs text-left">
                <thead>
                  <tr className="border-b border-slate-800 text-slate-400">
                    <th className="pb-3">Nama Obat</th>
                    <th className="pb-3">Kategori</th>
                    <th className="pb-3">No. Batch</th>
                    <th className="pb-3">Kadaluarsa</th>
                    <th className="pb-3">Sisa Stok</th>
                    <th className="pb-3">Status</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-800/60">
                  {medicines.map((m) => (
                    <tr key={m.id} className="hover:bg-slate-900/60 transition">
                      <td className="py-3 font-semibold text-white">{m.name}</td>
                      <td className="py-3 text-slate-400">{m.cat}</td>
                      <td className="py-3 font-mono text-slate-300">{m.batch}</td>
                      <td className="py-3 font-mono text-slate-400">{m.expiry}</td>
                      <td className="py-3 font-mono font-bold text-emerald-400">{m.stock}</td>
                      <td className="py-3">
                        <span className={`text-[10px] font-bold px-2 py-0.5 rounded ${
                          m.status.includes('Kritis') ? 'bg-rose-500/20 text-rose-400' :
                          m.status.includes('Waspada') ? 'bg-amber-500/20 text-amber-400' : 'bg-emerald-500/20 text-emerald-400'
                        }`}>
                          {m.status}
                        </span>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {/* Tab 4: Stock Opname */}
        {activeTab === 'stock_opname' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Smart Stock Opname & FEFO Tracker 🔍</h2>
                <p className="text-xs text-slate-400">Penyesuaian stok fisik nyata dan pelacak umur simpan obat.</p>
              </div>
              <div className="flex gap-2">
                <button onClick={() => window.print()} className="flex items-center gap-1 text-xs bg-slate-900 border border-slate-700 text-slate-300 px-3 py-2 rounded-xl">
                  <Printer className="w-3.5 h-3.5" /> Cetak Berita Acara
                </button>
                <button onClick={() => showToast("Hasil Stock Opname Fisik Disimpan!", "success")} className="flex items-center gap-1 text-xs font-bold bg-emerald-700 hover:bg-emerald-600 text-white px-3.5 py-2 rounded-xl shadow-glow-primary">
                  <Save className="w-3.5 h-3.5" /> Simpan Penyesuaian
                </button>
              </div>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div className="p-4 rounded-2xl bg-rose-950/30 border border-rose-900/50 text-rose-300 space-y-1">
                <div className="flex items-center gap-2 font-bold text-xs"><AlertOctagon className="w-4 h-4" /> KRITIS (&lt; 30 HARI)</div>
                <div className="text-2xl font-bold font-mono">1 Batch</div>
                <small className="text-[10px]">Wajib Karantina / Retur</small>
              </div>
              <div className="p-4 rounded-2xl bg-amber-950/30 border border-amber-900/50 text-amber-300 space-y-1">
                <div className="flex items-center gap-2 font-bold text-xs"><AlertTriangle className="w-4 h-4" /> WASPADA FEFO (&lt; 90 HARI)</div>
                <div className="text-2xl font-bold font-mono">2 Batch</div>
                <small className="text-[10px]">Prioritas Dikeluarkan Pertama</small>
              </div>
              <div className="p-4 rounded-2xl bg-emerald-950/30 border border-emerald-900/50 text-emerald-300 space-y-1">
                <div className="flex items-center gap-2 font-bold text-xs"><CheckCircle2 className="w-4 h-4" /> STOK AMAN (&gt; 6 BULAN)</div>
                <div className="text-2xl font-bold font-mono">18 Batch</div>
                <small className="text-[10px]">Kondisi Penyimpanan Baik</small>
              </div>
            </div>
          </div>
        )}

        {/* Tab 5: Tambah Obat */}
        {activeTab === 'tambah_obat' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Input Master Obat & Penerimaan Batch ➕</h2>
              <p className="text-xs text-slate-400">Registrasi obat baru dan pencatatan tanggal masuk per batch pabrik.</p>
            </div>

            <div className="glass-panel rounded-2xl p-6 max-w-xl border border-slate-800">
              <form onSubmit={handleAddMed} className="space-y-4">
                <div>
                  <label className="text-xs font-semibold text-slate-300 block mb-1">Nama Obat & Dosis</label>
                  <input
                    type="text"
                    required
                    value={medName}
                    onChange={(e) => setMedName(e.target.value)}
                    placeholder="Contoh: Cefixime 200mg"
                    className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-teal-500"
                  />
                </div>

                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <label className="text-xs font-semibold text-slate-300 block mb-1">Nomor Batch</label>
                    <input
                      type="text"
                      value={medBatch}
                      onChange={(e) => setMedBatch(e.target.value)}
                      placeholder="CFX-202609"
                      className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800"
                    />
                  </div>
                  <div>
                    <label className="text-xs font-semibold text-slate-300 block mb-1">Jumlah Masuk</label>
                    <input
                      type="number"
                      value={medStock}
                      onChange={(e) => setMedStock(e.target.value)}
                      className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800"
                    />
                  </div>
                </div>

                <div>
                  <label className="text-xs font-semibold text-slate-300 block mb-1">Tanggal Kadaluarsa (Expired Date)</label>
                  <input
                    type="date"
                    value={medExpiry}
                    onChange={(e) => setMedExpiry(e.target.value)}
                    className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800"
                  />
                </div>

                <button
                  type="submit"
                  className="w-full bg-teal-700 hover:bg-teal-600 text-white text-xs font-bold py-3 rounded-xl shadow-glow-primary transition flex items-center justify-center gap-2"
                >
                  <Save className="w-4 h-4" /> Simpan Obat & Cetak Kartu Stok
                </button>
              </form>
            </div>
          </div>
        )}

      </main>
    </div>
  );
}
