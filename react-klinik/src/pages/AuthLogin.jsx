import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { LogIn, User, Stethoscope, Pill, CreditCard, Shield, ShieldCheck, ArrowRight } from 'lucide-react';
import { useClinic } from '../context/ClinicContext';

export default function AuthLogin() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const { showToast } = useClinic();
  const navigate = useNavigate();

  const handleLogin = (e) => {
    e.preventDefault();
    const u = username.toLowerCase();
    showToast("Autentikasi Berhasil! Mengalihkan...", "success");
    setTimeout(() => {
      if (u.includes('dokter') || u.includes('agus')) navigate('/dokter');
      else if (u.includes('apotek') || u.includes('obat')) navigate('/apotek');
      else if (u.includes('kasir') || u.includes('bayar')) navigate('/kasir');
      else if (u.includes('admin')) navigate('/admin');
      else navigate('/pasien');
    }, 800);
  };

  const quickRoles = [
    { title: 'Pasien & Passport', sub: 'Achmad Nurhadi', path: '/pasien', icon: User, color: 'text-emerald-400', border: 'border-l-emerald-500' },
    { title: 'Dokter Pemeriksa', sub: 'dr. Agus Susanto', path: '/dokter', icon: Stethoscope, color: 'text-amber-400', border: 'border-l-amber-500' },
    { title: 'Apotek & Farmasi', sub: 'apt. Nurul Hidayah', path: '/apotek', icon: Pill, color: 'text-teal-400', border: 'border-l-teal-500' },
    { title: 'Kasir & Billing', sub: 'Serka M. Yusuf', path: '/kasir', icon: CreditCard, color: 'text-orange-400', border: 'border-l-orange-500' },
    { title: 'Admin IT & RBAC', sub: 'Super Admin', path: '/admin', icon: Shield, color: 'text-rose-400', border: 'border-l-rose-500' }
  ];

  return (
    <div className="flex items-center justify-center py-12 px-4">
      <div className="w-full max-w-2xl glass-panel rounded-3xl p-8 border border-slate-800 space-y-6 shadow-2xl">
        
        <div className="text-center space-y-2">
          <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold">
            <ShieldCheck className="w-3.5 h-3.5" /> PORTAL AUTENTIKASI STAF & PASIEN
          </span>
          <h2 className="text-2xl sm:text-3xl font-extrabold text-white">SIMKLINIK PRATAMA PUSDIKZI</h2>
          <p className="text-xs text-slate-400 max-w-md mx-auto">
            Silakan pilih hak akses role untuk masuk ke ruang kerja klinis masing-masing.
          </p>
        </div>

        {/* Quick Role Switcher */}
        <div className="space-y-3">
          <h4 className="text-xs font-bold text-slate-300">Akses Cepat Berdasarkan Peran (Demo):</h4>
          <div className="grid grid-cols-2 sm:grid-cols-3 gap-3">
            {quickRoles.map((r, idx) => {
              const Icon = r.icon;
              return (
                <button
                  key={idx}
                  onClick={() => navigate(r.path)}
                  className={`p-3 rounded-2xl bg-slate-900/80 hover:bg-slate-800/80 border border-slate-800 ${r.border} border-l-4 text-left transition flex items-center gap-2.5`}
                >
                  <div className={`w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center ${r.color}`}>
                    <Icon className="w-4 h-4" />
                  </div>
                  <div className="overflow-hidden">
                    <strong className="text-xs text-white block truncate">{r.title}</strong>
                    <small className="text-[10px] text-slate-400 truncate block">{r.sub}</small>
                  </div>
                </button>
              );
            })}
          </div>
        </div>

        {/* Form Login */}
        <form onSubmit={handleLogin} className="space-y-4 pt-2 border-t border-slate-800">
          <div>
            <label className="text-xs font-semibold text-slate-300 block mb-1">Username / NIK / Email Medis</label>
            <input
              type="text"
              required
              value={username}
              onChange={(e) => setUsername(e.target.value)}
              placeholder="Contoh: dokter_agus atau 3175081205900001"
              className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-emerald-500"
            />
          </div>

          <div>
            <label className="text-xs font-semibold text-slate-300 block mb-1">Kata Sandi / PIN Keamanan</label>
            <input
              type="password"
              required
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              placeholder="••••••••"
              className="w-full bg-slate-950 text-white text-xs px-3.5 py-2.5 rounded-xl border border-slate-800 focus:outline-none focus:border-emerald-500"
            />
          </div>

          <button
            type="submit"
            className="w-full bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold py-3.5 rounded-xl shadow-glow-primary transition flex items-center justify-center gap-2 mt-2"
          >
            <LogIn className="w-4 h-4" /> Masuk ke Sistem Informasi
          </button>
        </form>

        <div className="text-center pt-2">
          <Link to="/daftar" className="text-xs text-emerald-400 hover:text-emerald-300 font-semibold">
            Belum punya akun? Registrasi Pasien Baru di sini
          </Link>
        </div>

      </div>
    </div>
  );
}
