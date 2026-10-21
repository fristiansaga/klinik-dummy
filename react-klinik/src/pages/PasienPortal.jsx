import React, { useState } from 'react';
import { Activity, CalendarPlus, Clock, Pill, FileText, Printer, MessageCircle, QrCode, CheckCircle2, ShieldCheck } from 'lucide-react';
import Sidebar from '../components/Sidebar';
import { useClinic } from '../context/ClinicContext';

export default function PasienPortal() {
  const [activeTab, setActiveTab] = useState('passport');
  const { openWaSimulator, addBooking } = useClinic();
  const [bookingPoli, setBookingPoli] = useState('Poli Umum');
  const [bookingDokter, setBookingDokter] = useState('dr. Siti Rahmawati');
  const [bookingKeluhan, setBookingKeluhan] = useState('');

  const user = {
    name: 'Achmad Nurhadi',
    role: 'Pasien Umum / BPJS',
    initials: 'AN',
    avatarBg: 'bg-emerald-700'
  };

  const menuItems = [
    { id: 'passport', label: 'Health Passport', icon: Activity },
    { id: 'booking', label: 'Booking Kunjungan', icon: CalendarPlus },
    { id: 'antrean', label: 'Status Antrean Live', icon: Clock },
    { id: 'resep', label: 'Resep Digital', icon: Pill },
    { id: 'riwayat', label: 'Riwayat Rekam Medis', icon: FileText }
  ];

  const handleBooking = (e) => {
    e.preventDefault();
    addBooking('Achmad Nurhadi', bookingPoli);
    setBookingKeluhan('');
    setActiveTab('antrean');
  };

  return (
    <div className="flex flex-col md:flex-row gap-6 py-6">
      
      {/* Sidebar */}
      <Sidebar user={user} menuItems={menuItems} activeTab={activeTab} setActiveTab={setActiveTab} />

      {/* Main Content Workspace */}
      <main className="flex-1 space-y-6">
        
        {/* Tab 1: Digital Health Passport */}
        {activeTab === 'passport' && (
          <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Digital Health Passport 🪪</h2>
                <p className="text-xs text-slate-400">Identitas Pasien Terpadu & Ringkasan Rekam Kesehatan Digital.</p>
              </div>
              <div className="flex gap-2">
                <button 
                  onClick={() => openWaSimulator('antrean')}
                  className="flex items-center gap-1.5 text-xs font-semibold bg-[#075E54] hover:bg-[#064942] text-white px-3.5 py-2 rounded-xl transition"
                >
                  <MessageCircle className="w-3.5 h-3.5" /> Notifikasi WhatsApp
                </button>
                <button 
                  onClick={() => window.print()}
                  className="flex items-center gap-1.5 text-xs font-semibold bg-slate-900 border border-slate-700 text-slate-200 px-3.5 py-2 rounded-xl transition"
                >
                  <Printer className="w-3.5 h-3.5" /> Cetak Kartu
                </button>
              </div>
            </div>

            {/* Passport Card High Contrast */}
            <div className="rounded-3xl p-6 md:p-8 bg-gradient-to-br from-emerald-950 via-slate-900 to-slate-950 border-2 border-emerald-500/40 shadow-2xl relative overflow-hidden">
              <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div className="space-y-4">
                  <div className="flex items-center gap-3">
                    <div className="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg">
                      AN
                    </div>
                    <div>
                      <h3 className="text-xl font-extrabold text-white">Achmad Nurhadi</h3>
                      <span className="text-xs font-semibold text-emerald-400">NIK: 3175081205900001</span>
                    </div>
                  </div>

                  <div className="grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                      <span className="text-slate-400 block text-[10px]">No. Rekam Medis</span>
                      <strong className="text-white font-mono text-sm">RM-2026-0881</strong>
                    </div>
                    <div>
                      <span className="text-slate-400 block text-[10px]">Penjamin</span>
                      <strong className="text-emerald-400">BPJS Kesehatan (PBI)</strong>
                    </div>
                    <div>
                      <span className="text-slate-400 block text-[10px]">Golongan Darah</span>
                      <strong className="text-white">O (Rhesus +)</strong>
                    </div>
                  </div>
                </div>

                {/* Barcode & Security Badge */}
                <div className="bg-white p-3.5 rounded-2xl text-slate-950 text-center space-y-1 shadow-lg">
                  <div className="font-mono text-[9px] tracking-widest font-bold">|||| | | ||| || ||||| | ||</div>
                  <div className="text-[10px] font-bold">RM-2026-0881</div>
                  <span className="inline-block text-[8px] bg-emerald-100 text-emerald-800 font-bold px-1.5 py-0.5 rounded">
                    SATUSEHAT VERIFIED
                  </span>
                </div>
              </div>
            </div>

            {/* Quick Lab & Certificate Overview */}
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div className="glass-panel p-5 rounded-2xl border border-slate-800 space-y-2">
                <span className="text-[11px] font-bold text-emerald-400">HASIL LAB POCT TERAKHIR</span>
                <h4 className="text-sm font-bold text-white">Gula Darah Sewaktu (GDS)</h4>
                <div className="text-2xl font-mono font-bold text-white">112 <span className="text-xs text-slate-400">mg/dL (Normal)</span></div>
                <p className="text-[11px] text-slate-500">Pemeriksaan tanggal 28 Agustus 2026</p>
              </div>

              <div className="glass-panel p-5 rounded-2xl border border-slate-800 space-y-2">
                <span className="text-[11px] font-bold text-amber-400">SURAT DOKTER AKTIF</span>
                <h4 className="text-sm font-bold text-white">Surat Keterangan Berbadan Sehat (SKBS)</h4>
                <div className="text-sm text-emerald-400 font-semibold flex items-center gap-1.5">
                  <CheckCircle2 className="w-4 h-4" /> Berlaku s/d 30 Sept 2026
                </div>
                <p className="text-[11px] text-slate-500">Ditandatangani oleh dr. Agus Susanto, Sp.PD</p>
              </div>
            </div>
          </div>
        )}

        {/* Tab 2: Booking Kunjungan */}
        {activeTab === 'booking' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Booking Kunjungan & Antrean Online 📅</h2>
              <p className="text-xs text-slate-400">Pilih poliklinik dan dokter yang dituju untuk mendapatkan nomor antrean instan.</p>
            </div>

            <div className="glass-panel rounded-2xl p-6 max-w-xl border border-slate-800">
              <form onSubmit={handleBooking} className="space-y-4">
                <div>
                  <label className="text-xs font-semibold text-slate-300 block mb-1.5">Pilih Poliklinik Layanan</label>
                  <select
                    value={bookingPoli}
                    onChange={(e) => setBookingPoli(e.target.value)}
                    className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-emerald-500"
                  >
                    <option value="Poli Umum">Poli Umum & Medical Check Up</option>
                    <option value="Poli Penyakit Dalam">Poli Penyakit Dalam (Sp.PD)</option>
                    <option value="Poli Gigi">Poli Gigi & Mulut</option>
                    <option value="Poli KIA">Poli Ibu & Anak (KIA/KB)</option>
                  </select>
                </div>

                <div>
                  <label className="text-xs font-semibold text-slate-300 block mb-1.5">Pilih Dokter Praktik</label>
                  <select
                    value={bookingDokter}
                    onChange={(e) => setBookingDokter(e.target.value)}
                    className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-emerald-500"
                  >
                    <option value="dr. Agus Susanto, Sp.PD">dr. Agus Susanto, Sp.PD (08:00 - 13:00 WIB)</option>
                    <option value="dr. Siti Rahmawati">dr. Siti Rahmawati (13:00 - 18:00 WIB)</option>
                  </select>
                </div>

                <div>
                  <label className="text-xs font-semibold text-slate-300 block mb-1.5">Keluhan Utama / Gejala</label>
                  <textarea
                    rows={3}
                    required
                    value={bookingKeluhan}
                    onChange={(e) => setBookingKeluhan(e.target.value)}
                    placeholder="Contoh: Demam sejak 2 hari yang lalu..."
                    className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-emerald-500"
                  />
                </div>

                <button
                  type="submit"
                  className="w-full bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold py-3 rounded-xl shadow-glow-primary transition flex items-center justify-center gap-2"
                >
                  <CheckCircle2 className="w-4 h-4" /> Konfirmasi Booking Antrean
                </button>
              </form>
            </div>
          </div>
        )}

        {/* Tab 3: Antrean Live */}
        {activeTab === 'antrean' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Status Antrean Live ⏱️</h2>
              <p className="text-xs text-slate-400">Pantau posisi antrean Anda secara real-time.</p>
            </div>

            <div className="glass-panel border border-slate-800 rounded-3xl p-8 max-w-md mx-auto text-center space-y-4 shadow-2xl">
              <span className="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Nomor Antrean Anda</span>
              <div className="text-6xl font-extrabold text-emerald-400 font-mono my-2">A-004</div>
              <span className="inline-block text-xs font-bold px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full">
                Poli Penyakit Dalam (dr. Agus Susanto, Sp.PD)
              </span>
              <p className="text-xs text-slate-300 pt-2 border-t border-slate-800">
                Sedang Menunggu 1 Pasien Lagi (Nomor A-003 sedang dilayani di Ruang Periksa 2).
              </p>
            </div>
          </div>
        )}

        {/* Tab 4: Resep Digital */}
        {activeTab === 'resep' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Resep & Obat Digital 💊</h2>
              <p className="text-xs text-slate-400">Daftar resep obat aktif dan petunjuk minum.</p>
            </div>

            <div className="glass-panel rounded-2xl p-6 border border-slate-800 space-y-4">
              <div className="flex items-center justify-between border-b border-slate-800 pb-3">
                <div>
                  <h4 className="font-bold text-sm text-white">Resep No. RX-2026-0091</h4>
                  <span className="text-[11px] text-slate-500">dr. Agus Susanto, Sp.PD • 28 Agustus 2026</span>
                </div>
                <span className="text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-400">
                  Sudah Diambil
                </span>
              </div>

              <div className="space-y-3 text-xs">
                <div className="p-3 rounded-xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between">
                  <div>
                    <strong className="text-white block">Amlodipine 10mg</strong>
                    <span className="text-slate-400">1x Sehari 1 Tablet (Malam hari sesudah makan)</span>
                  </div>
                  <span className="font-mono text-emerald-400">30 Tab</span>
                </div>

                <div className="p-3 rounded-xl bg-slate-900/60 border border-slate-800/80 flex items-center justify-between">
                  <div>
                    <strong className="text-white block">Metformin 500mg</strong>
                    <span className="text-slate-400">2x Sehari 1 Tablet (Bersama makanan)</span>
                  </div>
                  <span className="font-mono text-emerald-400">60 Tab</span>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* Tab 5: Riwayat Rekam Medis */}
        {activeTab === 'riwayat' && (
          <div className="space-y-6">
            <div>
              <h2 className="text-2xl font-bold text-white">Riwayat Rekam Medis Pasien 📋</h2>
              <p className="text-xs text-slate-400">Histori kunjungan medis terenkripsi standar HL7 FHIR.</p>
            </div>

            <div className="space-y-3">
              <div className="glass-panel p-5 rounded-2xl border border-slate-800 space-y-2">
                <div className="flex items-center justify-between">
                  <span className="text-xs font-bold text-emerald-400">28 Agustus 2026</span>
                  <span className="text-[10px] font-bold px-2 py-0.5 bg-slate-800 text-slate-300 rounded">Poli Penyakit Dalam</span>
                </div>
                <h4 className="font-bold text-sm text-white">Hipertensi Primer Terkontrol (ICD-10: I10)</h4>
                <p className="text-xs text-slate-400">Keluhan tensi naik. TD: 135/85 mmHg, Nadi: 78x/m. Terapi dilanjutkan.</p>
              </div>

              <div className="glass-panel p-5 rounded-2xl border border-slate-800 space-y-2">
                <div className="flex items-center justify-between">
                  <span className="text-xs font-bold text-emerald-400">14 Juli 2026</span>
                  <span className="text-[10px] font-bold px-2 py-0.5 bg-slate-800 text-slate-300 rounded">Poli Umum</span>
                </div>
                <h4 className="font-bold text-sm text-white">Common Cold / ISPA Ringan (ICD-10: J00)</h4>
                <p className="text-xs text-slate-400">Batuk pilek 3 hari. Diberikan Paracetamol dan Multivitamin.</p>
              </div>
            </div>
          </div>
        )}

      </main>
    </div>
  );
}
