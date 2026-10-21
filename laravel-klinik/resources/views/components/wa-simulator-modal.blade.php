<!-- WhatsApp Phone Simulator Modal Component (AlpineJS / Vanilla Ready) -->
<div x-data="{
        open: false,
        activeTab: 'antrean',
        msgTitle: '📢 Panggilan Antrean Pasien',
        msgBody: 'Halo Bpk/Ibu *Achmad Nurhadi*,<br/><br/>Nomor antrean Anda *A-004* di *Poli Umum* segera dipanggil. Sisa 1 antrean lagi.<br/><br/>Mohon bersiap di Ruang Tunggu Poli Umum Lt. 1.',
        buttons: ['📱 Cek Status Antrean Live', '📍 Peta Ruang Tunggu'],
        replies: [],
        setTpl(type) {
            this.activeTab = type;
            if(type === 'antrean') {
                this.msgTitle = '📢 Panggilan Antrean Pasien';
                this.msgBody = 'Halo Bpk/Ibu *Achmad Nurhadi*,<br/><br/>Nomor antrean Anda *A-004* di *Poli Umum* segera dipanggil. Sisa 1 antrean lagi.<br/><br/>Mohon bersiap di Ruang Tunggu Poli Umum Lt. 1.';
                this.buttons = ['📱 Cek Status Antrean Live', '📍 Peta Ruang Tunggu'];
            } else if(type === 'obat_siap') {
                this.msgTitle = '💊 Obat Farmasi Siap Diambil';
                this.msgBody = 'Halo Bpk/Ibu *Achmad Nurhadi*,<br/><br/>E-Resep *RX-0830-05* telah *SELESAI DIRACIK & DIKEMAS* oleh Instalasi Farmasi KLINIK PUSDIKZI.<br/><br/>Silakan ambil obat di Loket Apotek Farmasi.';
                this.buttons = ['📄 Lihat E-Resep & Aturan Pakai', '⭐ Beri Ulasan'];
            } else if(type === 'kontrol_h1') {
                this.msgTitle = '📅 Pengingat Kontrol Ulang Dokter (H-1)';
                this.msgBody = 'Salam Sehat Bpk/Ibu *Ibu Siti Aminah*,<br/><br/>Jadwal Kontrol Rutin Poli Penyakit Dalam bersama *dr. Agus Susanto, Sp.PD* adalah *Besok, Senin Pkl 09:00 WIB*.';
                this.buttons = ['✅ Konfirmasi Hadir', '🔄 Reschedule'];
            } else if(type === 'surat_medis') {
                this.msgTitle = '📄 Surat Medis & Hasil Lab Terbit';
                this.msgBody = 'Halo Bpk/Ibu *Achmad Nurhadi*,<br/><br/>*Surat Keterangan Sakit Digital (2 Hari)* & *Hasil Lab POCT GDS: 110 mg/dL* Anda telah terverifikasi TTE SATUSEHAT.';
                this.buttons = ['📥 Download Surat Sakit (PDF)', '🧪 Lihat Hasil Lab'];
            }
        },
        sendReply() {
            this.replies.push('Terima kasih, saya segera menuju lokasi! 🙏');
        }
    }"
    @open-wa-modal.window="open = true; if($event.detail) setTpl($event.detail);"
    x-show="open" 
    x-cloak
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
    style="display: none;">

    <div class="relative w-full max-w-[390px] h-[660px] bg-slate-900 rounded-[38px] border-[8px] border-slate-800 shadow-2xl flex flex-col overflow-hidden">
        <!-- Phone Notch -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-5 bg-slate-800 rounded-b-xl z-20 flex items-center justify-center">
            <div class="w-2 h-2 rounded-full bg-black"></div>
        </div>

        <!-- WA Header -->
        <div class="bg-[#075E54] text-white pt-6 pb-2.5 px-3.5 flex items-center justify-between shadow z-10">
            <div class="flex items-center space-x-2.5">
                <button @click="open = false" class="text-white">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </button>
                <div class="w-8 h-8 rounded-full bg-white text-[#075E54] font-black text-xs flex items-center justify-center">
                    PZ
                </div>
                <div>
                    <h4 class="text-xs font-bold flex items-center gap-1">KLINIK PUSDIKZI <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-sky-400 fill-sky-400"></i></h4>
                    <span class="text-[10px] text-emerald-200">Verified Business Account</span>
                </div>
            </div>
            <button @click="open = false" class="text-white hover:text-rose-300">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Template Pills Switcher -->
        <div class="bg-[#054c44] px-2.5 py-1.5 flex gap-1.5 overflow-x-auto text-[11px]">
            <button @click="setTpl('antrean')" :class="activeTab === 'antrean' ? 'bg-[#128C7E] text-white font-bold' : 'bg-white/20 text-white'" class="px-2 py-0.5 rounded-full whitespace-nowrap">Antrean</button>
            <button @click="setTpl('obat_siap')" :class="activeTab === 'obat_siap' ? 'bg-[#128C7E] text-white font-bold' : 'bg-white/20 text-white'" class="px-2 py-0.5 rounded-full whitespace-nowrap">Obat Siap</button>
            <button @click="setTpl('kontrol_h1')" :class="activeTab === 'kontrol_h1' ? 'bg-[#128C7E] text-white font-bold' : 'bg-white/20 text-white'" class="px-2 py-0.5 rounded-full whitespace-nowrap">Kontrol H-1</button>
            <button @click="setTpl('surat_medis')" :class="activeTab === 'surat_medis' ? 'bg-[#128C7E] text-white font-bold' : 'bg-white/20 text-white'" class="px-2 py-0.5 rounded-full whitespace-nowrap">Surat/Lab</button>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 bg-[#EFEAE2] p-3 overflow-y-auto space-y-3 text-slate-800 text-xs">
            <div class="text-center">
                <span class="bg-white text-slate-600 text-[10px] px-2 py-0.5 rounded shadow-sm">HARI INI</span>
            </div>

            <!-- Incoming Bot Bubble -->
            <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm max-w-[90%] space-y-2">
                <div class="font-bold text-[#075E54] flex items-center gap-1">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                    <span x-html="msgTitle"></span>
                </div>
                <div x-html="msgBody" class="leading-relaxed text-slate-700"></div>

                <div class="pt-2 border-t border-slate-100 space-y-1.5">
                    <template x-for="btn in buttons" :key="btn">
                        <button class="w-full bg-slate-50 border border-slate-200 text-sky-700 font-semibold py-1 px-2 rounded-lg text-center text-[11px] hover:bg-slate-100">
                            <span x-text="btn"></span>
                        </button>
                    </template>
                </div>
                <div class="text-right text-[10px] text-slate-400">09:42 ✓✓</div>
            </div>

            <!-- User Replies -->
            <template x-for="rep in replies" :key="rep">
                <div class="flex justify-end">
                    <div class="bg-[#DCF8C6] text-slate-900 p-2.5 rounded-2xl rounded-tr-none shadow-sm max-w-[85%] text-xs">
                        <p x-text="rep"></p>
                        <div class="text-right text-[9px] text-slate-500 mt-1">09:43 ✓✓</div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Footer Bar -->
        <div class="bg-[#F0F2F5] p-2.5 flex items-center space-x-2">
            <input type="text" class="flex-1 bg-white rounded-full px-3.5 py-1.5 text-xs text-slate-800 outline-none" value="Terima kasih, saya segera menuju lokasi! 🙏" readonly />
            <button @click="sendReply()" class="w-8 h-8 rounded-full bg-[#075E54] text-white flex items-center justify-center hover:bg-[#128C7E]">
                <i data-lucide="send" class="w-3.5 h-3.5"></i>
            </button>
        </div>
    </div>
</div>
