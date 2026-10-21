import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { Shield, ShieldCheck, Building2, Stethoscope, Activity, Smile, Heart, Pill, Siren, ArrowRight, UserPlus, Tv, Ticket, CheckCircle2 } from 'lucide-react';
import { useClinic } from '../context/ClinicContext';
import { mockPoliklinik } from '../data/mockData';

export default function LandingPage() {
  const { addBooking, showToast } = useClinic();
  const [quickName, setQuickName] = useState('');
  const [quickPoli, setQuickPoli] = useState('Poli Umum');
  const [quickPenjamin, setQuickPenjamin] = useState('BPJS Kesehatan');

  const handleQuickSubmit = (e) => {
    e.preventDefault();
    if (!quickName.trim()) return;
    const no = addBooking(quickName, quickPoli);
    setQuickName('');
    showToast(`Tiket Antrean Diterbitkan: ${no} (${quickPoli})`, 'success');
  };

  const polyclinics = [
    { name: 'Poli Umum & MCU', icon: Stethoscope, border: 'border-t-emerald-500', bg: 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-400', badge: 'Buka Setiap Hari', hours: '07:30 - 21:00 WIB', desc: 'Pemeriksaan dokter umum menyeluruh, pengobatan primer, surat keterangan sehat (SKBS), dan MCU dinas prajurit.' },
    { name: 'Poli Penyakit Dalam (Sp.PD)', icon: Activity, border: 'border-t-amber-500', bg: 'bg-amber-500/10 text-amber-700 dark:text-amber-400', badge: 'Dokter Spesialis', hours: '08:00 - 13:00 WIB', desc: 'Konsultasi mendalam penyakit kardiovaskular, hipertensi, diabetes melitus, gangguan ginjal, dan uji lab POCT.' },
    { name: 'Poli Gigi & Mulut', icon: Smile, border: 'border-t-orange-500', bg: 'bg-orange-500/10 text-orange-700 dark:text-orange-400', badge: 'Dental Modern', hours: '09:00 - 15:00 WIB', desc: 'Penambalan gigi sinar komposit, pembersihan karang gigi (scaling), pencabutan gigi, serta sterilisasi autoclave.' },
    { name: 'Poli KIA, KB & Imunisasi', icon: Heart, border: 'border-t-purple-500', bg: 'bg-purple-500/10 text-purple-700 dark:text-purple-400', badge: 'Ibu & Anak', hours: '08:00 - 14:00 WIB', desc: 'Pemeriksaan kehamilan teratur (ANC), imunisasi dasar bayi & balita, pelayanan KB berencana, dan tumbuh kembang.' },
    { name: 'Instalasi Farmasi & Apotek', icon: Pill, border: 'border-t-teal-500', bg: 'bg-teal-500/10 text-teal-700 dark:text-teal-400', badge: 'E-Resep Cepat', hours: 'Siaga 24 Jam', desc: 'Penyediaan obat generik & paten berkualitas, dispensing tepat dosis, serta integrasi notifikasi WhatsApp.' },
    { name: 'IGD & Ambulans 24 Jam', icon: Siren, border: 'border-t-rose-500', bg: 'bg-rose-500/10 text-rose-700 dark:text-rose-400', badge: 'Emergency 24/7', hours: 'Siaga Penuh', desc: 'Pelayanan gawat darurat trauma medis, penanganan luka akut, resusitasi, serta armada ambulans siaga rujukan RS.' }
  ];

  return (
    <div className="space-y-16 py-8">
      
      {/* Hero Section */}
      <section className="relative overflow-hidden rounded-3xl glass-panel border border-slate-200 dark:border-slate-800 p-8 md:p-14 transition-all duration-300">
        <div className="absolute -right-20 -top-20 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <div className="max-w-3xl space-y-6 relative z-10">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-bold">
            <ShieldCheck className="w-3.5 h-3.5" /> FASKES TINGKAT I TNI AD • KODE PPK: 0115B001
          </div>
          <h1 className="text-3xl md:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
            Layanan Kesehatan Terpadu <br />
            <span className="bg-gradient-to-r from-emerald-600 via-teal-600 to-amber-600 dark:from-emerald-400 dark:via-teal-300 dark:to-amber-400 bg-clip-text text-transparent">
              PUSDIKZI KODIKLAT TNI-AD
            </span>
          </h1>
          <p className="text-sm md:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
            Menyelenggarakan pelayanan rekam medis elektronik (RME) terstandar Permenkes RI No. 24/2022, terintegrasi SATUSEHAT Kemenkes, serta melayani peserta BPJS Kesehatan dan masyarakat umum.
          </p>

          <div className="flex flex-wrap items-center gap-4 pt-2">
            <Link to="/pasien" className="flex items-center gap-2 bg-emerald-700 hover:bg-emerald-600 text-white text-xs md:text-sm font-bold px-6 py-3.5 rounded-xl shadow-glow-primary transition">
              <Activity className="w-4 h-4" /> Buka Digital Health Passport
            </Link>
            <Link to="/daftar" className="flex items-center gap-2 bg-white hover:bg-slate-100 dark:bg-slate-900 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-200 border border-slate-300 dark:border-slate-700 text-xs md:text-sm font-semibold px-6 py-3.5 rounded-xl transition shadow-sm">
              <UserPlus className="w-4 h-4" /> Pendaftaran Pasien Baru
            </Link>
          </div>
        </div>
      </section>

      {/* Quick Queue Take & Live Polyclinic Status */}
      <section className="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {/* Quick Ticket Form */}
        <div className="lg:col-span-1 glass-panel rounded-2xl p-6 border border-slate-200 dark:border-slate-800 space-y-4">
          <div className="flex items-center gap-2.5">
            <div className="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 flex items-center justify-center">
              <Ticket className="w-4 h-4" />
            </div>
            <div>
              <h3 className="font-bold text-sm text-slate-900 dark:text-white">Ambil Antrean Mandiri</h3>
              <p className="text-[11px] text-slate-500 dark:text-slate-400">Dapatkan nomor antrean instan</p>
            </div>
          </div>

          <form onSubmit={handleQuickSubmit} className="space-y-3 pt-2">
            <div>
              <label className="text-[11px] font-semibold text-slate-700 dark:text-slate-300 block mb-1">Nama Pasien</label>
              <input
                type="text"
                required
                value={quickName}
                onChange={(e) => setQuickName(e.target.value)}
                placeholder="Nama lengkap pasien..."
                className="w-full bg-white dark:bg-slate-950 text-slate-900 dark:text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-800 focus:outline-none focus:border-emerald-500"
              />
            </div>

            <div>
              <label className="text-[11px] font-semibold text-slate-700 dark:text-slate-300 block mb-1">Pilih Poliklinik</label>
              <select
                value={quickPoli}
                onChange={(e) => setQuickPoli(e.target.value)}
                className="w-full bg-white dark:bg-slate-950 text-slate-900 dark:text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-800 focus:outline-none focus:border-emerald-500"
              >
                <option value="Poli Umum">Poli Umum & MCU</option>
                <option value="Poli Penyakit Dalam">Poli Penyakit Dalam (Sp.PD)</option>
                <option value="Poli Gigi">Poli Gigi & Mulut</option>
                <option value="Poli KIA">Poli KIA & KB</option>
              </select>
            </div>

            <div>
              <label className="text-[11px] font-semibold text-slate-700 dark:text-slate-300 block mb-1">Penjamin Biaya</label>
              <select
                value={quickPenjamin}
                onChange={(e) => setQuickPenjamin(e.target.value)}
                className="w-full bg-white dark:bg-slate-950 text-slate-900 dark:text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-800 focus:outline-none focus:border-emerald-500"
              >
                <option value="BPJS Kesehatan">BPJS Kesehatan (Faskes 1)</option>
                <option value="Umum">Umum / Tunai</option>
                <option value="Dinas TNI-AD">Dinas TNI-AD / PNS</option>
              </select>
            </div>

            <button
              type="submit"
              className="w-full bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold py-3 rounded-xl shadow-glow-primary transition mt-2 flex items-center justify-center gap-2"
            >
              <CheckCircle2 className="w-4 h-4" /> Cetak Nomor Antrean
            </button>
          </form>
        </div>

        {/* Live Queue Cards */}
        <div className="lg:col-span-2 space-y-4">
          <div className="flex items-center justify-between">
            <div>
              <h3 className="font-bold text-base text-slate-900 dark:text-white">Status Antrean Poliklinik Saat Ini</h3>
              <p className="text-xs text-slate-500 dark:text-slate-400">Pantau nomor antrean yang sedang berlangsung di ruang periksa.</p>
            </div>
            <Link to="/antrian-tv" target="_blank" className="text-xs font-semibold text-emerald-700 dark:text-emerald-400 hover:text-emerald-600 flex items-center gap-1">
              <Tv className="w-3.5 h-3.5" /> Fullscreen Display TV
            </Link>
          </div>

          <div className="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
            {mockPoliklinik.slice(0, 4).map((poli, idx) => (
              <div key={idx} className="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 text-center space-y-1 shadow-sm">
                <span className="text-[10px] uppercase font-bold tracking-wider text-slate-500 dark:text-slate-400 truncate block">
                  {poli.name}
                </span>
                <div className="text-3xl font-extrabold text-slate-900 dark:text-white my-1 font-mono">{poli.queue}</div>
                <span className="inline-block text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold truncate max-w-full">
                  {poli.doctor}
                </span>
              </div>
            ))}
          </div>
        </div>

      </section>

      {/* 6 Polyclinic & Facility Cards */}
      <section className="space-y-8">
        <div className="text-center space-y-2">
          <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-bold">
            <Building2 className="w-3.5 h-3.5" /> POLIKLINIK & INSTALASI MEDIS FKTP
          </span>
          <h2 className="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white">Layanan Poliklinik Unggulan PUSDIKZI</h2>
          <p className="text-xs md:text-sm text-slate-500 dark:text-slate-400 max-w-xl mx-auto">
            Didukung oleh dokter spesialis, dokter gigi, bidan berpengalaman, dan peralatan medis standar internasional.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {polyclinics.map((p, idx) => {
            const Icon = p.icon;
            return (
              <div key={idx} className={`glass-panel border border-slate-200 dark:border-slate-800 ${p.border} border-t-4 rounded-2xl p-6 flex flex-col justify-between card-hover-glow`}>
                <div className="space-y-3">
                  <div className="flex items-center justify-between">
                    <div className={`w-12 h-12 rounded-xl ${p.bg} flex items-center justify-center`}>
                      <Icon className="w-6 h-6" />
                    </div>
                    <span className="text-[10px] font-bold px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                      {p.badge}
                    </span>
                  </div>
                  <h3 className="font-bold text-base text-slate-900 dark:text-white">{p.name}</h3>
                  <p className="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{p.desc}</p>
                </div>

                <div className="pt-4 mt-4 border-t border-slate-200 dark:border-slate-800/80 flex items-center justify-between">
                  <span className="text-[11px] text-slate-500">{p.hours}</span>
                  <Link to="/pasien" className="text-xs font-bold text-emerald-700 dark:text-emerald-400 hover:text-emerald-600 flex items-center gap-1">
                    Booking <ArrowRight className="w-3.5 h-3.5" />
                  </Link>
                </div>
              </div>
            );
          })}
        </div>

        {/* Staff Portal Entry Banner */}
        <div className="bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 rounded-2xl p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 flex items-center justify-center">
              <Shield className="w-5 h-5" />
            </div>
            <div>
              <strong className="text-xs md:text-sm text-slate-900 dark:text-white block">Apakah Anda Dokter atau Petugas Medis Klinik?</strong>
              <p className="text-[11px] text-slate-500 dark:text-slate-400">Masuk ke ruang kerja EMR SOAP, farmasi dispensing, dan kasir billing via portal login resmi.</p>
            </div>
          </div>
          <Link to="/login" className="bg-slate-100 hover:bg-slate-200 dark:bg-slate-900 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-200 border border-slate-300 dark:border-slate-700 text-xs font-semibold px-4 py-2 rounded-xl flex items-center gap-1.5 whitespace-nowrap transition">
            Portal Staf Medis <ArrowRight className="w-3.5 h-3.5" />
          </Link>
        </div>
      </section>

    </div>
  );
}
