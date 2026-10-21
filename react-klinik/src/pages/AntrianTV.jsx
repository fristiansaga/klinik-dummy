import React, { useState, useEffect } from 'react';
import { Shield, Volume2, Clock, Tv } from 'lucide-react';
import { useClinic } from '../context/ClinicContext';
import { mockPoliklinik } from '../data/mockData';

export default function AntrianTV() {
  const { currentCalling, callPatient } = useClinic();
  const [timeStr, setTimeStr] = useState(new Date().toLocaleTimeString('id-ID'));
  const [dateStr, setDateStr] = useState(new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }));

  useEffect(() => {
    const timer = setInterval(() => {
      const now = new Date();
      setTimeStr(now.toLocaleTimeString('id-ID'));
    }, 1000);
    return () => clearInterval(timer);
  }, []);

  return (
    <div className="fixed inset-0 z-50 bg-slate-950 text-white flex flex-col justify-between p-6 sm:p-10 select-none overflow-hidden font-sans">
      
      {/* Top Header Bar */}
      <header className="flex items-center justify-between pb-6 border-b border-slate-800">
        <div className="flex items-center gap-4">
          <div className="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-800 to-emerald-600 flex items-center justify-center shadow-glow-primary">
            <Shield className="w-8 h-8 text-white" />
          </div>
          <div>
            <h1 className="text-2xl sm:text-3xl font-extrabold tracking-tight">KLINIK PRATAMA PUSDIKZI</h1>
            <p className="text-sm font-semibold text-emerald-400">KODIKLAT TNI-AD • SISTEM ANTREAN DIGITAL MULTI-POLI</p>
          </div>
        </div>

        {/* Real-time Clock */}
        <div className="text-right">
          <div className="text-3xl sm:text-4xl font-extrabold font-mono text-emerald-400 tracking-wider">
            {timeStr} <span className="text-sm text-slate-400">WIB</span>
          </div>
          <div className="text-xs font-semibold text-slate-400">{dateStr}</div>
        </div>
      </header>

      {/* Main Grid View */}
      <main className="grid grid-cols-1 lg:grid-cols-12 gap-8 my-auto py-6">
        
        {/* Left Calling Box */}
        <div className="lg:col-span-6 bg-gradient-to-br from-emerald-950/80 via-slate-900 to-slate-950 border-2 border-emerald-500/50 rounded-3xl p-8 sm:p-10 flex flex-col justify-between shadow-2xl relative overflow-hidden">
          <div className="flex items-center justify-between">
            <span className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 text-xs sm:text-sm font-extrabold animate-pulse">
              <Volume2 className="w-4 h-4" /> SEDANG DIPANGGIL SAAT INI
            </span>
            <span className="text-xs text-slate-400 font-mono">RUANG PERIKSA 2</span>
          </div>

          <div className="text-center my-6 space-y-2">
            <div className="text-7xl sm:text-9xl font-black font-mono tracking-tight text-white drop-shadow-[0_0_35px_rgba(16,185,129,0.5)]">
              {currentCalling.no}
            </div>
            <h2 className="text-2xl sm:text-3xl font-bold text-emerald-300 truncate">
              {currentCalling.name}
            </h2>
            <span className="inline-block text-base sm:text-lg font-bold text-slate-300">
              {currentCalling.poli}
            </span>
          </div>

          <div className="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 flex items-center justify-between">
            <span className="text-xs text-slate-400">Pemeriksa: <strong>dr. Agus Susanto, Sp.PD</strong></span>
            <button
              onClick={() => callPatient(currentCalling)}
              className="flex items-center gap-1 text-xs bg-emerald-700 hover:bg-emerald-600 px-3 py-1.5 rounded-lg font-bold transition"
            >
              <Volume2 className="w-3.5 h-3.5" /> Ulangi Panggilan
            </button>
          </div>
        </div>

        {/* Right Multi-Poli Queues */}
        <div className="lg:col-span-6 grid grid-cols-2 gap-4">
          {mockPoliklinik.slice(0, 4).map((p, idx) => (
            <div key={idx} className="bg-slate-900 border border-slate-800 rounded-3xl p-6 flex flex-col justify-between text-center space-y-2 shadow-lg">
              <span className="text-xs uppercase font-extrabold tracking-wider text-slate-400">{p.name}</span>
              <div className="text-5xl font-black font-mono text-emerald-400 my-1">{p.queue}</div>
              <p className="text-xs font-semibold text-slate-300 truncate">{p.doctor}</p>
            </div>
          ))}
        </div>

      </main>

      {/* Bottom Running Marquee */}
      <footer className="bg-slate-900/90 border border-slate-800 rounded-2xl p-3 text-xs text-slate-300 flex items-center justify-between">
        <div className="flex items-center gap-2 font-bold text-emerald-400 whitespace-nowrap pl-2">
          <span>📢 PENGUMUMAN :</span>
        </div>
        <marquee className="flex-1 px-4 text-slate-300 font-medium">
          Selamat Datang di KLINIK PRATAMA PUSDIKZI KODIKLAT TNI-AD. Pasien BPJS Kesehatan Wajib Membawa KTP / Kartu KIS. Tersedia Layanan Konsultasi Dokter Spesialis Penyakit Dalam Setiap Hari Kerja.
        </marquee>
      </footer>

    </div>
  );
}
