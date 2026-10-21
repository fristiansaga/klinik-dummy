import React, { useState } from 'react';
import { HelpCircle, X, Send, LifeBuoy, Bot } from 'lucide-react';

export default function ChatbotWidget() {
  const [open, setOpen] = useState(false);
  const [input, setInput] = useState('');
  const [messages, setMessages] = useState([
    { from: 'bot', text: 'Halo! Selamat datang di KLINIK PRATAMA PUSDIKZI. Ada yang bisa kami bantu seputar jadwal poli, antrean, atau BPJS?' }
  ]);

  const quickChips = [
    { key: 'jadwal', label: '🕒 Jam Buka', reply: 'Layanan Poliklinik buka pukul 07:30 - 21:00 WIB. Instalasi Gawat Darurat (IGD) & Farmasi siaga 24 Jam.' },
    { key: 'bpjs', label: '💳 Terima BPJS?', reply: 'Ya! Klinik Pratama PUSDIKZI melayani pasien BPJS Kesehatan (Faskes 1) bebas biaya 100% (Rp 0).' },
    { key: 'booking', label: '📅 Cara Booking', reply: 'Anda dapat mengambil nomor antrean online melalui menu Portal Pasien > Booking Kunjungan.' },
    { key: 'lokasi', label: '📍 Lokasi PUSDIKZI', reply: 'Jl. Jenderal Sudirman No. 45, Pabaton, Bogor Tengah (Depan Pusdikzi Kodiklat TNI-AD).' }
  ];

  const handleSend = (text) => {
    if (!text.trim()) return;
    const newMsgs = [...messages, { from: 'user', text }];
    setMessages(newMsgs);
    setInput('');

    setTimeout(() => {
      setMessages([...newMsgs, { 
        from: 'bot', 
        text: `Pertanyaan mengenai "${text}" telah dicatat. Petugas call center kami juga siap melayani via telepon di (0251) 832-1234.` 
      }]);
    }, 600);
  };

  const handleChip = (chip) => {
    const newMsgs = [
      ...messages,
      { from: 'user', text: chip.label },
      { from: 'bot', text: chip.reply }
    ];
    setMessages(newMsgs);
  };

  return (
    <div className="fixed bottom-6 right-6 z-50">
      {/* Floating Trigger Button */}
      {!open && (
        <button
          onClick={() => setOpen(true)}
          className="w-14 h-14 rounded-full bg-gradient-to-tr from-emerald-800 to-emerald-600 hover:from-emerald-700 hover:to-emerald-500 text-white flex items-center justify-center shadow-glow-primary hover:scale-105 transition"
          title="Pusat Bantuan & FAQ"
        >
          <HelpCircle className="w-7 h-7" />
        </button>
      )}

      {/* Chatbot Panel */}
      {open && (
        <div className="w-[360px] sm:w-[400px] h-[480px] bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl flex flex-col overflow-hidden animate-in fade-in slide-in-from-bottom-5">
          {/* Header */}
          <div className="bg-gradient-to-r from-emerald-900 to-emerald-800 p-4 flex items-center justify-between text-white border-b border-emerald-700/50">
            <div className="flex items-center gap-2.5">
              <div className="w-8 h-8 rounded-lg bg-emerald-700 flex items-center justify-center">
                <LifeBuoy className="w-4 h-4 text-emerald-200" />
              </div>
              <div>
                <h4 className="font-bold text-xs text-white">Pusat Bantuan PUSDIKZI</h4>
                <p className="text-[10px] text-emerald-200">Asisten Digital Siaga 24 Jam</p>
              </div>
            </div>
            <button onClick={() => setOpen(false)} className="text-emerald-200 hover:text-white">
              <X className="w-5 h-5" />
            </button>
          </div>

          {/* Body Messages */}
          <div className="flex-1 p-4 overflow-y-auto space-y-3 bg-slate-950/60">
            {messages.map((m, idx) => (
              <div key={idx} className={`flex ${m.from === 'user' ? 'justify-end' : 'justify-start'}`}>
                <div className={`max-w-[80%] rounded-2xl p-3 text-xs leading-relaxed ${
                  m.from === 'user' 
                    ? 'bg-emerald-700 text-white rounded-br-none' 
                    : 'bg-slate-800 text-slate-200 border border-slate-700/60 rounded-bl-none'
                }`}>
                  {m.text}
                </div>
              </div>
            ))}

            {/* Quick Chips */}
            <div className="flex flex-wrap gap-1.5 pt-2">
              {quickChips.map((c) => (
                <button
                  key={c.key}
                  onClick={() => handleChip(c)}
                  className="text-[11px] font-medium bg-slate-900 hover:bg-slate-800 text-emerald-400 border border-emerald-900/60 hover:border-emerald-700 rounded-full px-2.5 py-1 transition"
                >
                  {c.label}
                </button>
              ))}
            </div>
          </div>

          {/* Input Footer */}
          <div className="p-3 bg-slate-900 border-t border-slate-800 flex items-center gap-2">
            <input
              type="text"
              value={input}
              onChange={(e) => setInput(e.target.value)}
              onKeyDown={(e) => e.key === 'Enter' && handleSend(input)}
              placeholder="Ketik pertanyaan Anda..."
              className="flex-1 bg-slate-950 text-slate-200 placeholder-slate-500 border border-slate-800 rounded-xl px-3 py-2 text-xs focus:outline-none focus:border-emerald-500"
            />
            <button
              onClick={() => handleSend(input)}
              className="w-9 h-9 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white flex items-center justify-center transition"
            >
              <Send className="w-4 h-4" />
            </button>
          </div>
        </div>
      )}
    </div>
  );
}
