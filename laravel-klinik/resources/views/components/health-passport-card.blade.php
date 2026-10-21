@props(['patient'])

<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#062c19] to-[#02160d] border-2 border-emerald-500 p-6 md:p-8 text-white shadow-2xl shadow-emerald-950/50 mb-6">
    <!-- Background Shield Icon Glow -->
    <div class="absolute -right-8 -bottom-10 opacity-10 pointer-events-none text-emerald-400">
        <i data-lucide="shield-plus" class="w-72 h-72"></i>
    </div>

    <!-- Header Section -->
    <div class="relative z-10 flex flex-col md:flex-row md:items-start justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-3">
                <span class="bg-emerald-500 text-emerald-950 font-black text-xs px-3 py-1 rounded-md tracking-wider">
                    🪪 KARTU PASIEN DIGITAL PUSDIKZI
                </span>
                <span class="bg-white/10 text-white border border-white/20 text-xs px-2.5 py-0.5 rounded-md font-mono">
                    IHS: {{ $patient['ihs_id'] ?? 'P-8829103991' }}
                </span>
            </div>
            
            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight drop-shadow-md mb-2">
                {{ $patient['nama'] }}
            </h2>

            <div class="flex items-center gap-3 text-sm text-slate-300 font-medium">
                <span>No. RM: 
                    <strong class="text-emerald-300 font-mono text-base bg-black/40 px-2 py-0.5 rounded border border-emerald-500/50">
                        {{ $patient['no_rm'] }}
                    </strong>
                </span>
                <span class="text-emerald-500">•</span>
                <span>NIK: <strong class="text-white font-mono tracking-wider">{{ $patient['nik'] }}</strong></span>
            </div>
        </div>

        <div class="md:text-right">
            <span class="inline-block bg-amber-400 text-slate-950 font-extrabold text-xs px-3.5 py-1.5 rounded-full shadow-lg shadow-amber-400/20">
                ✓ {{ strtoupper($patient['penjamin']) }} AKTIF
            </span>
            <p class="text-xs text-emerald-300 font-semibold mt-2 drop-shadow">
                Faskes 1 KLINIK PRATAMA PUSDIKZI
            </p>
        </div>
    </div>

    <!-- 4-Column Grid Chips -->
    <div class="relative z-10 grid grid-cols-2 md:grid-cols-4 gap-3 mt-6">
        <div class="bg-black/40 border border-white/15 rounded-xl p-3.5 backdrop-blur-sm">
            <span class="text-[11px] text-emerald-400 font-bold uppercase tracking-wider block mb-1">
                Golongan Darah
            </span>
            <p class="font-extrabold text-lg text-white">{{ $patient['gol_darah'] }}</p>
        </div>

        <div class="bg-black/40 border border-white/15 rounded-xl p-3.5 backdrop-blur-sm">
            <span class="text-[11px] text-emerald-400 font-bold uppercase tracking-wider block mb-1">
                Tanggal Lahir
            </span>
            <p class="font-extrabold text-sm md:text-base text-white">{{ $patient['tgl_lahir'] }}</p>
        </div>

        <div class="bg-black/40 border border-rose-500/40 rounded-xl p-3.5 backdrop-blur-sm">
            <span class="text-[11px] text-rose-300 font-bold uppercase tracking-wider block mb-1">
                Riwayat Alergi
            </span>
            <p class="font-extrabold text-sm md:text-base text-rose-200">{{ $patient['alergi'] }}</p>
        </div>

        <div class="bg-black/40 border border-white/15 rounded-xl p-3.5 backdrop-blur-sm">
            <span class="text-[11px] text-emerald-400 font-bold uppercase tracking-wider block mb-1">
                No. Kartu BPJS
            </span>
            <p class="font-extrabold text-sm md:text-base text-white font-mono">{{ $patient['bpjs'] }}</p>
        </div>
    </div>
</div>
