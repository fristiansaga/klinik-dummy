<!-- Quick Queue Blade Partial -->
<div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 md:p-8 max-w-3xl mx-auto mb-10 shadow-xl">
    <div class="text-center mb-6">
        <span class="bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold px-3 py-1 rounded-full">
            LOKET DIGITAL INSTAN
        </span>
        <h2 class="text-xl md:text-2xl font-bold text-white mt-2 flex items-center justify-center gap-2">
            <i data-lucide="ticket" class="w-6 h-6 text-emerald-400"></i> Ambil Antrean Cepat
        </h2>
        <p class="text-xs text-slate-400 mt-1">Dapatkan nomor antrean hari ini langsung tanpa antre di loket fisik.</p>
    </div>

    <!-- Live Counter Box -->
    <div class="grid grid-cols-2 gap-4 bg-slate-950/80 border border-slate-800 rounded-2xl p-4 mb-6 text-center">
        <div class="border-r border-slate-800">
            <span class="text-[11px] text-slate-400 font-semibold uppercase">Sedang Dipanggil</span>
            <p class="text-3xl font-black text-emerald-400 mt-1">A-003</p>
        </div>
        <div>
            <span class="text-[11px] text-slate-400 font-semibold uppercase">Nomor Anda Berikutnya</span>
            <p class="text-3xl font-black text-amber-400 mt-1">A-004</p>
        </div>
    </div>

    <form class="space-y-4">
        <div>
            <label class="text-xs font-bold text-slate-300 block mb-1">Nama Lengkap Pasien / NIK</label>
            <input type="text" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white outline-none focus:border-emerald-500" value="Achmad Nurhadi" required />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
                <label class="text-xs font-bold text-slate-300 block mb-1">Pilih Poliklinik</label>
                <select class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white outline-none focus:border-emerald-500">
                    <option>Poli Umum & MCU</option>
                    <option>Poli Penyakit Dalam (Sp.PD)</option>
                    <option>Poli Gigi & Mulut</option>
                    <option>Poli KIA & Kebidanan</option>
                </select>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-300 block mb-1">Jenis Penjamin</label>
                <select class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white outline-none focus:border-emerald-500">
                    <option>BPJS Kesehatan (Faskes 1)</option>
                    <option>Pasien Umum / Tunai</option>
                    <option>Anggota Dinas TNI-AD / PNS</option>
                </select>
            </div>
        </div>

        <button type="button" onclick="alert('Tiket Antrean A-004 Berhasil Dicetak!')" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-xl text-xs flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/30 transition">
            <i data-lucide="printer" class="w-4 h-4"></i> Cetak & Ambil Tiket Antrean (A-004)
        </button>
    </form>
</div>
