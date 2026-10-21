import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Search, Activity, Stethoscope, Pill, CreditCard, Shield, Tv, X } from 'lucide-react';
import { useClinic } from '../context/ClinicContext';

export default function CommandPalette() {
  const { cmdOpen, setCmdOpen } = useClinic();
  const [query, setQuery] = useState('');
  const navigate = useNavigate();

  if (!cmdOpen) return null;

  const items = [
    { title: 'Portal Pasien & Health Passport', path: '/pasien', badge: 'Pasien', icon: Activity, color: 'text-emerald-400' },
    { title: 'Clinical Workspace Dokter & EMR SOAP', path: '/dokter', badge: 'Dokter', icon: Stethoscope, color: 'text-amber-400' },
    { title: 'Instalasi Farmasi & Stock Opname FEFO', path: '/apotek', badge: 'Apotek', icon: Pill, color: 'text-teal-400' },
    { title: 'Kasir & Smart Billing Pembayaran', path: '/kasir', badge: 'Kasir', icon: CreditCard, color: 'text-orange-400' },
    { title: 'Admin Command Center & RBAC', path: '/admin', badge: 'Admin', icon: Shield, color: 'text-rose-400' },
    { title: 'Layar Display TV Antrean Fullscreen', path: '/antrian-tv', badge: 'Display TV', icon: Tv, color: 'text-sky-400' }
  ];

  const filtered = items.filter(i => i.title.toLowerCase().includes(query.toLowerCase()) || i.badge.toLowerCase().includes(query.toLowerCase()));

  const handleSelect = (path) => {
    setCmdOpen(false);
    navigate(path);
  };

  return (
    <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-start justify-center pt-24 px-4">
      <div className="w-full max-w-xl bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in-95">
        
        {/* Input Bar */}
        <div className="p-4 border-b border-slate-800 flex items-center gap-3">
          <Search className="w-5 h-5 text-slate-400" />
          <input
            type="text"
            autoFocus
            value={query}
            onChange={(e) => setQuery(e.target.value)}
            placeholder="Cari modul, dokter, pasien, atau menu..."
            className="flex-1 bg-transparent text-white placeholder-slate-500 text-sm focus:outline-none"
          />
          <button onClick={() => setCmdOpen(false)} className="text-slate-500 hover:text-slate-300">
            <kbd className="text-[10px] bg-slate-800 px-2 py-1 rounded border border-slate-700">ESC</kbd>
          </button>
        </div>

        {/* Results List */}
        <div className="p-2 max-h-80 overflow-y-auto space-y-1">
          {filtered.map((item, idx) => {
            const Icon = item.icon;
            return (
              <button
                key={idx}
                onClick={() => handleSelect(item.path)}
                className="w-full flex items-center justify-between p-3 rounded-xl hover:bg-slate-800/80 transition text-left group"
              >
                <div className="flex items-center gap-3">
                  <div className={`w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center ${item.color}`}>
                    <Icon className="w-4 h-4" />
                  </div>
                  <span className="text-xs font-semibold text-slate-200 group-hover:text-white">{item.title}</span>
                </div>
                <span className="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-800 text-slate-400 group-hover:text-slate-200">
                  {item.badge}
                </span>
              </button>
            );
          })}
        </div>

      </div>
    </div>
  );
}
