import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { UserPlus, CheckCircle2, Shield } from 'lucide-react';
import { useClinic } from '../context/ClinicContext';

export default function AuthDaftar() {
  const [nik, setNik] = useState('');
  const [nama, setNama] = useState('');
  const [penjamin, setPenjamin] = useState('BPJS Kesehatan');
  const [pin, setPin] = useState('');
  const [pin2, setPin2] = useState('');
  const { showToast } = useClinic();
  const navigate = useNavigate();

  const handleRegister = (e) => {
    e.preventDefault();
    if (pin !== pin2) {
      alert("Konfirmasi PIN tidak cocok!");
      return;
    }
    const rm = `RM-2026-${Math.floor(1000 + Math.random() * 9000)}`;
    showToast(`Registrasi Berhasil! Nomor RM Anda: ${rm}`, 'success');
    setTimeout(() => {
      navigate('/pasien');
    }, 1200);
  };

  return (
    <div className="flex items-center justify-center py-12 px-4">
      <div className="w-full max-w-2xl glass-panel rounded-3xl p-8 border border-slate-800 space-y-6 shadow-2xl">
        
        <div className="text-center space-y-2">
          <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold">
            <UserPlus className="w-3.5 h-3.5" /> Self-Service Registration
          </span>
          <h2 className="text-2xl sm:text-3xl font-extrabold text-white">Pendaftaran Pasien Baru</h2>
          <p className="text-xs text-slate-400 max-w-md mx-auto">
            Daftarkan diri Anda untuk mendapatkan <strong>Nomor Rekam Medis (No. RM)</strong> dan <strong>Digital Health Passport</strong> resmi.
          </p>
        </div>

        <form onSubmit={handleRegister} className="space-y-4">
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label className="text-xs font-semibold text-slate-300 block mb-1">Nomor Induk Kependudukan (NIK) *</label>
              <input
                type="text"
                required
                maxLength={16}
                value={nik}
                onChange={(e) => setNik(e.target.value)}
                placeholder="16 Digit NIK KTP..."
                className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-emerald-500"
              />
            </div>
            <div>
              <label className="text-xs font-semibold text-slate-300 block mb-1">Nama Lengkap (Sesuai KTP) *</label>
              <input
                type="text"
                required
                value={nama}
                onChange={(e) => setNama(e.target.value)}
                placeholder="Nama lengkap tanpa singkatan..."
                className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-emerald-500"
              />
            </div>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
              <label className="text-xs font-semibold text-slate-300 block mb-1">Tanggal Lahir *</label>
              <input type="date" defaultValue="1995-01-01" className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800" />
            </div>
            <div>
              <label className="text-xs font-semibold text-slate-300 block mb-1">Jenis Kelamin</label>
              <select className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800">
                <option>Laki-laki</option>
                <option>Perempuan</option>
              </select>
            </div>
            <div>
              <label className="text-xs font-semibold text-slate-300 block mb-1">Penjamin Biaya</label>
              <select 
                value={penjamin} 
                onChange={(e) => setPenjamin(e.target.value)}
                className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800"
              >
                <option value="BPJS Kesehatan">BPJS Kesehatan (Faskes 1)</option>
                <option value="Umum">Umum / Tunai</option>
                <option value="Dinas TNI-AD">Dinas TNI-AD / PNS</option>
              </select>
            </div>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label className="text-xs font-semibold text-slate-300 block mb-1">Buat PIN Keamanan (6 Angka) *</label>
              <input
                type="password"
                required
                maxLength={6}
                value={pin}
                onChange={(e) => setPin(e.target.value)}
                placeholder="••••••"
                className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800"
              />
            </div>
            <div>
              <label className="text-xs font-semibold text-slate-300 block mb-1">Konfirmasi PIN *</label>
              <input
                type="password"
                required
                maxLength={6}
                value={pin2}
                onChange={(e) => setPin2(e.target.value)}
                placeholder="••••••"
                className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800"
              />
            </div>
          </div>

          <button
            type="submit"
            className="w-full bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold py-3.5 rounded-xl shadow-glow-primary transition flex items-center justify-center gap-2 mt-4"
          >
            <CheckCircle2 className="w-4 h-4" /> Daftarkan & Dapatkan Health Passport
          </button>
        </form>

      </div>
    </div>
  );
}
