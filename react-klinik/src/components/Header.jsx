import React, { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { Shield, Search, Moon, Sun, Menu, X, UserPlus, LogIn, ExternalLink } from 'lucide-react';
import { useClinic } from '../context/ClinicContext';

export default function Header() {
  const { theme, setTheme, setCmdOpen } = useClinic();
  const [mobileNavOpen, setMobileNavOpen] = useState(false);
  const location = useLocation();

  const isDashboard = ['/pasien', '/dokter', '/apotek', '/kasir', '/admin'].some(path => location.pathname.startsWith(path));

  return (
    <header className="sticky top-0 z-40 w-full glass-panel border-b border-slate-200/80 dark:border-slate-800/80 transition-all duration-300">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        
        {/* Brand Logo & Title */}
        <div className="flex items-center gap-3">
          <Link to="/" className="flex items-center gap-2.5 group">
            <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-800 to-emerald-600 text-white flex items-center justify-center shadow-glow-primary group-hover:scale-105 transition">
              <Shield className="w-5 h-5 text-emerald-100" />
            </div>
            <div>
              <div className="flex items-center gap-2">
                <span className="font-extrabold text-base tracking-tight text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">
                  KLINIK PRATAMA PUSDIKZI
                </span>
                <span className="hidden sm:inline-block text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20 rounded-full">
                  TNI-AD
                </span>
              </div>
              <p className="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Sistem Informasi Medis & RME Terpadu</p>
            </div>
          </Link>
        </div>

        {/* Search Shortcut & Navigation */}
        <div className="hidden md:flex items-center gap-4">
          <button 
            onClick={() => setCmdOpen(true)}
            className="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-900/80 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 border border-slate-300 dark:border-slate-700/60 rounded-xl px-3.5 py-1.5 text-xs transition shadow-sm"
          >
            <Search className="w-3.5 h-3.5" />
            <span>Cari Modul / Pasien...</span>
            <kbd className="bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 px-1.5 py-0.5 rounded text-[10px] font-mono border border-slate-300 dark:border-slate-700">Ctrl+K</kbd>
          </button>

          <Link to="/antrian-tv" target="_blank" className="flex items-center gap-1.5 text-xs font-semibold text-sky-700 dark:text-sky-400 hover:text-sky-800 dark:hover:text-sky-300 bg-sky-500/10 border border-sky-500/20 px-3 py-1.5 rounded-xl transition">
            <ExternalLink className="w-3.5 h-3.5" /> TV Antrean
          </Link>
        </div>

        {/* Right Actions: Theme, Notifications, Auth */}
        <div className="flex items-center gap-2.5">
          <button 
            onClick={() => setTheme(theme === 'dark' ? 'light' : 'dark')}
            className="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-900 dark:hover:bg-slate-800 border border-slate-300 dark:border-slate-800 text-slate-700 dark:text-slate-300 flex items-center justify-center transition shadow-sm"
            title="Toggle Theme"
          >
            {theme === 'dark' ? <Sun className="w-4 h-4 text-amber-400" /> : <Moon className="w-4 h-4 text-indigo-600" />}
          </button>

          {!isDashboard ? (
            <div className="flex items-center gap-2">
              <Link to="/daftar" className="hidden sm:flex items-center gap-1.5 text-xs font-semibold text-slate-700 hover:text-slate-950 dark:text-slate-200 dark:hover:text-white bg-slate-100 hover:bg-slate-200 dark:bg-slate-900 dark:hover:bg-slate-800 border border-slate-300 dark:border-slate-700 px-3.5 py-2 rounded-xl transition shadow-sm">
                <UserPlus className="w-3.5 h-3.5" /> Daftar Pasien
              </Link>
              <Link to="/login" className="flex items-center gap-1.5 text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-600 px-4 py-2 rounded-xl shadow-glow-primary transition">
                <LogIn className="w-3.5 h-3.5" /> Portal Login
              </Link>
            </div>
          ) : (
            <div className="flex items-center gap-2 bg-slate-100 dark:bg-slate-900/90 border border-slate-300 dark:border-slate-800 rounded-xl px-3 py-1.5">
              <div className="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold">
                KP
              </div>
              <span className="text-xs font-semibold text-slate-700 dark:text-slate-200 hidden sm:inline">Staf Aktif</span>
            </div>
          )}

          {/* Mobile Menu Button */}
          <button 
            onClick={() => setMobileNavOpen(!mobileNavOpen)}
            className="md:hidden w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-300 dark:border-slate-800 text-slate-700 dark:text-slate-300 flex items-center justify-center shadow-sm"
          >
            {mobileNavOpen ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
          </button>
        </div>

      </div>

      {/* Mobile Drawer Navigation */}
      {mobileNavOpen && (
        <div className="md:hidden px-4 pt-2 pb-6 bg-white/95 dark:bg-slate-950/95 border-b border-slate-200 dark:border-slate-800 space-y-2">
          <Link to="/" onClick={() => setMobileNavOpen(false)} className="block px-3 py-2 rounded-lg text-sm text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900 font-medium">Beranda</Link>
          <Link to="/pasien" onClick={() => setMobileNavOpen(false)} className="block px-3 py-2 rounded-lg text-sm text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900 font-medium">Portal Pasien</Link>
          <Link to="/dokter" onClick={() => setMobileNavOpen(false)} className="block px-3 py-2 rounded-lg text-sm text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900 font-medium">Clinical Dokter</Link>
          <Link to="/apotek" onClick={() => setMobileNavOpen(false)} className="block px-3 py-2 rounded-lg text-sm text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900 font-medium">Farmasi & Obat</Link>
          <Link to="/kasir" onClick={() => setMobileNavOpen(false)} className="block px-3 py-2 rounded-lg text-sm text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900 font-medium">Kasir & Billing</Link>
          <Link to="/admin" onClick={() => setMobileNavOpen(false)} className="block px-3 py-2 rounded-lg text-sm text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900 font-medium">Admin Center</Link>
        </div>
      )}
    </header>
  );
}
