import React from 'react';
import { ShieldCheck } from 'lucide-react';

export default function Sidebar({ user, menuItems, activeTab, setActiveTab }) {
  return (
    <aside className="w-full md:w-64 flex-shrink-0 glass-panel rounded-2xl p-5 flex flex-col justify-between border border-slate-200 dark:border-slate-800 self-start sticky top-24">
      <div className="space-y-6">
        
        {/* User Identity Card */}
        <div className="flex items-center gap-3 pb-5 border-b border-slate-200 dark:border-slate-800/80">
          <div className={`w-12 h-12 rounded-2xl ${user.avatarBg || 'bg-emerald-600'} text-white flex items-center justify-center font-bold text-base shadow-md`}>
            {user.initials}
          </div>
          <div className="overflow-hidden">
            <h4 className="font-bold text-sm text-slate-900 dark:text-white truncate">{user.name}</h4>
            <span className={`inline-block text-[10px] font-bold px-2 py-0.5 rounded-md ${user.badgeClass || 'bg-emerald-500/20 text-emerald-700 dark:text-emerald-400'}`}>
              {user.role}
            </span>
          </div>
        </div>

        {/* Menu Navigation Items */}
        <nav className="space-y-1">
          {menuItems.map((item) => {
            const Icon = item.icon;
            const isActive = activeTab === item.id;
            return (
              <button
                key={item.id}
                onClick={() => setActiveTab(item.id)}
                className={`w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition text-left ${
                  isActive 
                    ? 'bg-emerald-700 text-white shadow-glow-primary' 
                    : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-900/60'
                }`}
              >
                <Icon className={`w-4 h-4 ${isActive ? 'text-white' : 'text-slate-500 dark:text-slate-400'}`} />
                <span>{item.label}</span>
              </button>
            );
          })}
        </nav>
      </div>

      {/* Integration Badge Status */}
      <div className="pt-6 mt-6 border-t border-slate-200 dark:border-slate-800/80">
        <div className="bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-900/60 rounded-xl p-3">
          <div className="flex items-center gap-2 text-emerald-700 dark:text-emerald-400 mb-1">
            <ShieldCheck className="w-4 h-4" />
            <strong className="text-xs">SATUSEHAT Aktif</strong>
          </div>
          <p className="text-[10px] text-slate-600 dark:text-slate-400 leading-tight">
            IHS ID: P-8829103991 terverifikasi Kemenkes RI.
          </p>
        </div>
      </div>
    </aside>
  );
}
