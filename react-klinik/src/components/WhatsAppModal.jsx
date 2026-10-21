import React from 'react';
import { MessageCircle, X, CheckCheck, Send } from 'lucide-react';
import { useClinic } from '../context/ClinicContext';

export default function WhatsAppModal() {
  const { waModalOpen, setWaModalOpen, waType, showToast } = useClinic();

  if (!waModalOpen) return null;

  return (
    <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
      <div className="w-full max-w-md bg-[#0B141A] rounded-2xl overflow-hidden shadow-2xl border border-emerald-950 animate-in zoom-in-95">
        
        {/* WA Header */}
        <div className="bg-[#202C33] p-4 flex items-center justify-between text-white border-b border-slate-700">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-full bg-[#00A884] text-white flex items-center justify-center font-bold">
              KZ
            </div>
            <div>
              <h4 className="font-bold text-sm text-white">KLINIK PRATAMA PUSDIKZI</h4>
              <p className="text-[10px] text-[#00A884] flex items-center gap-1 font-semibold">
                <span className="w-1.5 h-1.5 rounded-full bg-[#00A884]"></span> Official Medical Notification
              </p>
            </div>
          </div>
          <button onClick={() => setWaModalOpen(false)} className="text-slate-400 hover:text-white">
            <X className="w-5 h-5" />
          </button>
        </div>

        {/* Chat Body */}
        <div className="p-4 space-y-3 bg-[#0B141A] min-h-[260px] text-xs">
          <div className="bg-[#111B21] text-slate-200 border border-slate-800 rounded-2xl p-4 space-y-2 leading-relaxed">
            <p className="font-bold text-[#00A884]">🏛️ KLINIK PRATAMA PUSDIKZI BOGOR</p>
            <p>Halo Bapak/Ibu <strong>Achmad Nurhadi</strong>,</p>
            {waType === 'antrean' ? (
              <p>
                Nomor antrean Anda adalah <strong>A-004</strong> di Poli Penyakit Dalam (dr. Agus Susanto, Sp.PD). Saat ini antrean nomor <strong>A-003</strong> sedang dilayani. Mohon bersiap di ruang tunggu.
              </p>
            ) : (
              <p>
                Resep digital Anda telah selesai diracik oleh Instalasi Farmasi. Silakan mengambil obat di <strong>Loket Apotek (F-020)</strong> dengan menunjukkan pesan ini.
              </p>
            )}
            <div className="flex justify-end items-center gap-1 text-[10px] text-slate-500 pt-2 border-t border-slate-800">
              <span>09:42 WIB</span>
              <CheckCheck className="w-3.5 h-3.5 text-[#53BDEB]" />
            </div>
          </div>
        </div>

        {/* Footer Actions */}
        <div className="p-3 bg-[#202C33] flex items-center gap-2">
          <input
            type="text"
            placeholder="Balas pesan WhatsApp..."
            className="flex-1 bg-[#2A3942] text-white text-xs px-3 py-2 rounded-xl focus:outline-none placeholder-slate-400"
          />
          <button 
            onClick={() => {
              showToast("Balasan WhatsApp Terkirim!", "success");
              setWaModalOpen(false);
            }}
            className="w-9 h-9 rounded-xl bg-[#00A884] hover:bg-[#02906F] text-white flex items-center justify-center transition"
          >
            <Send className="w-4 h-4" />
          </button>
        </div>

      </div>
    </div>
  );
}
