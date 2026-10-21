<div class="space-y-6" wire:poll.3s>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2">
                <i data-lucide="monitor" class="w-6 h-6 text-emerald-400"></i>
                Display & Pemanggilan Antrian Real-Time
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Layar monitor pemanggilan pasien per Poli Klinik Pratama PUSDIKZI</p>
        </div>
        <div class="self-start sm:self-auto flex items-center space-x-2 bg-emerald-500/10 border border-emerald-500/30 px-3 py-1.5 rounded-xl text-xs text-emerald-400 font-semibold">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping mr-1"></span> Livewire Auto-Sync (3s)
        </div>
    </div>

    <!-- Active Call Main Display -->
    <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-emerald-950/60 via-slate-900/80 to-slate-950/90 border-2 border-emerald-500/50 backdrop-blur-2xl shadow-2xl shadow-emerald-500/10 text-center relative overflow-hidden">
        <div class="max-w-xl mx-auto">
            <p class="text-[11px] sm:text-xs uppercase tracking-widest text-emerald-400 font-extrabold mb-1">NOMOR ANTRIAN DIPANGGIL SAAT INI</p>
            <div class="text-5xl sm:text-7xl font-black text-white tracking-tight py-3 sm:py-4 drop-shadow-lg font-mono">
                {{ $antrianSedangDipanggil->nomor_antrian ?? '--' }}
            </div>
            <div class="mt-1 sm:mt-2 text-lg sm:text-xl font-bold text-emerald-300">
                {{ $antrianSedangDipanggil->pasien->nama_lengkap ?? 'Menunggu Antrian Berikutnya' }}
            </div>
            <div class="mt-1 text-xs sm:text-sm text-slate-300 font-medium">
                {{ $antrianSedangDipanggil->poli->nama_poli ?? '-' }} | {{ $antrianSedangDipanggil->dokter->nama_lengkap ?? 'Dokter Jaga' }}
            </div>
        </div>
    </div>

    <!-- Antrian Cards Per Poli -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($antrianPerPoli as $poli)
        <div class="p-5 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-slate-700/50 pb-3 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-sm">
                            {{ substr($poli->kode_poli, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-sm">{{ $poli->nama_poli }}</h4>
                            <p class="text-[11px] text-slate-400">{{ $poli->antrians->count() }} antrian aktif</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2.5">
                    @forelse($poli->antrians as $item)
                    <div class="p-3 rounded-xl bg-slate-900/70 border border-slate-800 flex items-center justify-between">
                        <div>
                            <span class="text-sm font-black text-emerald-400">{{ $item->nomor_antrian }}</span>
                            <p class="text-xs font-semibold text-white mt-0.5">{{ $item->pasien->nama_lengkap }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($item->status === 'menunggu')
                                <button wire:click="panggilNomor({{ $item->id }})" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-xs font-bold transition flex items-center shadow-md shadow-emerald-600/30">
                                    <i data-lucide="volume-2" class="w-3.5 h-3.5 mr-1"></i> Panggil
                                </button>
                            @elseif($item->status === 'dipanggil')
                                <button wire:click="selesaiPemeriksaan({{ $item->id }})" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-500 text-white rounded-lg text-xs font-bold transition flex items-center shadow-md">
                                    <i data-lucide="check" class="w-3.5 h-3.5 mr-1"></i> Selesai
                                </button>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-center py-6 text-slate-500 text-xs">Tidak ada antrian di poli ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
