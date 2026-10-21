import React, { useState } from 'react';
import { Gauge, ShieldCheck, Database, Wifi, Printer, Plus, UserPlus, Server } from 'lucide-react';
import Sidebar from '../components/Sidebar';
import { mockTarifMaster } from '../data/mockData';

export default function AdminCenter() {
  const [activeTab, setActiveTab] = useState('beranda');

  const user = {
    name: 'Administrator IT',
    role: 'Super Admin IT',
    initials: 'AD',
    avatarBg: 'bg-rose-600',
    badgeClass: 'bg-rose-500/20 text-rose-400'
  };

  const menuItems = [
    { id: 'beranda', label: 'Executive Analytics', icon: Gauge },
    { id: 'rbac', label: 'Hak Akses & User (RBAC)', icon: ShieldCheck },
    { id: 'master_data', label: 'Master Tarif Layanan', icon: Database },
    { id: 'integrasi', label: 'Integrasi SATUSEHAT', icon: Wifi }
  ];

  return (
    <div className="flex flex-col md:flex-row gap-6 py-6">
      <Sidebar user={user} menuItems={menuItems} activeTab={activeTab} setActiveTab={setActiveTab} />

      <main className="flex-1 space-y-6">
        
        {/* Tab 1: Executive Analytics */}
        {activeTab === 'beranda' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Executive Analytics & Command Center 📊</h2>
                <p className="text-xs text-slate-400">Ringkasan performa layanan klinis, KPI pasien, dan monitoring pendapatan.</p>
              </div>
              <button onClick={() => window.print()} className="flex items-center gap-2 text-xs font-bold bg-rose-700 hover:bg-rose-600 text-white px-4 py-2.5 rounded-xl transition">
                <Printer className="w-4 h-4" /> Cetak Laporan Eksekutif
              </button>
            </div>

            {/* KPI Cards */}
            <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-emerald-400">KUNJUNGAN HARI INI</span>
                <div className="text-2xl font-bold font-mono text-white">85 Pasien</div>
                <small className="text-[10px] text-slate-400">+12% vs Kemarin</small>
              </div>
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-sky-400">SATUSEHAT SYNC</span>
                <div className="text-2xl font-bold font-mono text-white">100%</div>
                <small className="text-[10px] text-slate-400">85 dari 85 EMR Terkirim</small>
              </div>
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-amber-400">WAKTU TUNGGU RATA-RATA</span>
                <div className="text-2xl font-bold font-mono text-white">8.4 Menit</div>
                <small className="text-[10px] text-slate-400">Target &lt; 15 Menit (Baik)</small>
              </div>
              <div className="glass-panel p-4 rounded-2xl border border-slate-800 space-y-1">
                <span className="text-[10px] font-bold text-rose-400">SYSTEM UPTIME</span>
                <div className="text-2xl font-bold font-mono text-white">99.98%</div>
                <small className="text-[10px] text-slate-400">Server Stabil</small>
              </div>
            </div>

            {/* Visual Analytics Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="glass-panel p-6 rounded-2xl border border-slate-800 space-y-3">
                <h4 className="font-bold text-sm text-white">Tren Kunjungan 6 Hari Terakhir</h4>
                <div className="h-40 flex items-end justify-between gap-2 pt-6">
                  {['Sen (65)', 'Sel (82)', 'Rab (74)', 'Kam (90)', 'Jum (85)', 'Sab (45)'].map((label, idx) => {
                    const heights = ['65%', '82%', '74%', '90%', '85%', '45%'];
                    return (
                      <div key={idx} className="flex-1 flex flex-col items-center gap-2">
                        <div 
                          style={{ height: heights[idx] }} 
                          className="w-full bg-gradient-to-t from-emerald-800 to-emerald-500 rounded-t-lg transition hover:brightness-125"
                        ></div>
                        <span className="text-[9px] text-slate-400 truncate">{label.split(' ')[0]}</span>
                      </div>
                    );
                  })}
                </div>
              </div>

              <div className="glass-panel p-6 rounded-2xl border border-slate-800 space-y-3">
                <h4 className="font-bold text-sm text-white">10 Besar Diagnosa Penyakit Terbanyak</h4>
                <div className="space-y-2 text-xs">
                  <div className="flex justify-between items-center"><span className="text-slate-300">1. ISPA Akut (J00)</span><strong className="text-emerald-400">35 Kasus (35%)</strong></div>
                  <div className="w-full bg-slate-800 h-2 rounded-full overflow-hidden"><div className="bg-emerald-500 h-full w-[35%]"></div></div>

                  <div className="flex justify-between items-center"><span className="text-slate-300">2. Hipertensi Primer (I10)</span><strong className="text-amber-400">25 Kasus (25%)</strong></div>
                  <div className="w-full bg-slate-800 h-2 rounded-full overflow-hidden"><div className="bg-amber-500 h-full w-[25%]"></div></div>

                  <div className="flex justify-between items-center"><span className="text-slate-300">3. Dispepsia Lambung (K30)</span><strong className="text-sky-400">18 Kasus (18%)</strong></div>
                  <div className="w-full bg-slate-800 h-2 rounded-full overflow-hidden"><div className="bg-sky-500 h-full w-[18%]"></div></div>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* Tab 2: RBAC Users */}
        {activeTab === 'rbac' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Role-Based Access Control (RBAC) 🔐</h2>
                <p className="text-xs text-slate-400">Manajemen akun staf medis, dokter, apoteker, dan kasir.</p>
              </div>
              <button className="flex items-center gap-1.5 text-xs font-bold bg-rose-700 hover:bg-rose-600 text-white px-4 py-2 rounded-xl">
                <UserPlus className="w-4 h-4" /> Tambah Pengguna
              </button>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 overflow-x-auto">
              <table className="w-full text-xs text-left">
                <thead>
                  <tr className="border-b border-slate-800 text-slate-400">
                    <th className="pb-3">Nama Pengguna</th>
                    <th className="pb-3">Username</th>
                    <th className="pb-3">Peran (Role)</th>
                    <th className="pb-3">Status</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-800/60">
                  <tr className="hover:bg-slate-900/60"><td className="py-3 font-semibold text-white">dr. Agus Susanto, Sp.PD</td><td className="py-3 font-mono text-slate-400">dokter_agus</td><td className="py-3 text-amber-400 font-bold">Dokter Spesialis</td><td className="py-3"><span className="text-[10px] bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded font-bold">Aktif</span></td></tr>
                  <tr className="hover:bg-slate-900/60"><td className="py-3 font-semibold text-white">apt. Nurul Hidayah, S.Farm</td><td className="py-3 font-mono text-slate-400">apotek_nurul</td><td className="py-3 text-teal-400 font-bold">Kepala Farmasi</td><td className="py-3"><span className="text-[10px] bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded font-bold">Aktif</span></td></tr>
                  <tr className="hover:bg-slate-900/60"><td className="py-3 font-semibold text-white">Serka M. Yusuf</td><td className="py-3 font-mono text-slate-400">kasir_yusuf</td><td className="py-3 text-orange-400 font-bold">Kasir & Keuangan</td><td className="py-3"><span className="text-[10px] bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded font-bold">Aktif</span></td></tr>
                  <tr className="hover:bg-slate-900/60"><td className="py-3 font-semibold text-white">Administrator IT PUSDIKZI</td><td className="py-3 font-mono text-slate-400">admin_it</td><td className="py-3 text-rose-400 font-bold">Super Admin</td><td className="py-3"><span className="text-[10px] bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded font-bold">Aktif</span></td></tr>
                </tbody>
              </table>
            </div>
          </div>
        )}

        {/* Tab 3: Master Data Tarif */}
        {activeTab === 'master_data' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Master Data Tarif Layanan 🏥</h2>
                <p className="text-xs text-slate-400">Konfigurasi tarif tindakan medis umum dan penjamin BPJS Kesehatan.</p>
              </div>
              <button className="flex items-center gap-1.5 text-xs font-bold bg-rose-700 hover:bg-rose-600 text-white px-4 py-2 rounded-xl">
                <Plus className="w-4 h-4" /> Tambah Tarif
              </button>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 overflow-x-auto">
              <table className="w-full text-xs text-left">
                <thead>
                  <tr className="border-b border-slate-800 text-slate-400">
                    <th className="pb-3">Kode Tarif</th>
                    <th className="pb-3">Nama Tindakan</th>
                    <th className="pb-3">Poliklinik</th>
                    <th className="pb-3">Tarif BPJS</th>
                    <th className="pb-3">Tarif Umum</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-800/60">
                  {mockTarifMaster.map((t) => (
                    <tr key={t.id} className="hover:bg-slate-900/60">
                      <td className="py-3 font-mono font-bold text-rose-400">{t.code}</td>
                      <td className="py-3 font-semibold text-white">{t.name}</td>
                      <td className="py-3 text-slate-400">{t.poli}</td>
                      <td className="py-3 text-emerald-400 font-bold">{t.bpjs === 0 ? 'Rp 0 (Cover 100%)' : `Rp ${t.bpjs.toLocaleString('id-ID')}`}</td>
                      <td className="py-3 text-white font-mono font-bold">Rp {t.umum.toLocaleString('id-ID')}</td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {/* Tab 4: Integrasi SATUSEHAT */}
        {activeTab === 'integrasi' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Integrasi SATUSEHAT & Audit Trail 🌐</h2>
              <p className="text-xs text-slate-400">Monitoring interoperabilitas HL7 FHIR API Kemenkes RI.</p>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 space-y-4">
              <div className="flex items-center gap-3 p-4 rounded-2xl bg-emerald-950/40 border border-emerald-900/60">
                <Server className="w-6 h-6 text-emerald-400" />
                <div>
                  <h4 className="font-bold text-sm text-white">Status Koneksi SATUSEHAT: Terhubung (Live)</h4>
                  <p className="text-xs text-slate-400">Organisasi ID: 100029910 • Secret Key: Valid s/d 2027</p>
                </div>
              </div>

              <div className="space-y-2 text-xs">
                <div className="p-3 rounded-xl bg-slate-900/60 border border-slate-800 flex justify-between">
                  <span>Encounter Pasien Achmad Nurhadi (RM-2026-0881)</span>
                  <span className="text-emerald-400 font-mono font-bold">HTTP 201 Created (Synced)</span>
                </div>
                <div className="p-3 rounded-xl bg-slate-900/60 border border-slate-800 flex justify-between">
                  <span>Condition Diagnosa ICD-10 I10</span>
                  <span className="text-emerald-400 font-mono font-bold">HTTP 201 Created (Synced)</span>
                </div>
              </div>
            </div>
          </div>
        )}

      </main>
    </div>
  );
}
