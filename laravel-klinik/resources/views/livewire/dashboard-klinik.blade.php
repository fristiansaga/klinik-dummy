<div class="space-y-6" wire:poll.10s>
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2">
                <i data-lucide="layout-dashboard" class="w-6 h-6 text-emerald-400"></i>
                Dashboard Pelayanan Medis
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Pemantauan operasional real-time Klinik Pratama PUSDIKZI</p>
        </div>
        <div class="flex space-x-3 self-start sm:self-auto">
            <a href="/pendaftaran" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs sm:text-sm font-semibold transition flex items-center shadow-lg shadow-emerald-600/30">
                <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i> Daftar Pasien Baru
            </a>
        </div>
    </div>

    <!-- Metrics KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="p-5 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl relative overflow-hidden group hover:border-emerald-500/40 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pasien</p>
                    <h3 class="text-2xl font-bold text-white mt-1">{{ number_format($totalPasien) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>
            </div>
            <p class="text-[11px] text-emerald-400 mt-3 flex items-center font-medium">
                <i data-lucide="database" class="w-3 h-3 mr-1"></i> Terdaftar di Rekam Medis
            </p>
        </div>

        <div class="p-5 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl relative overflow-hidden group hover:border-blue-500/40 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Antrian Hari Ini</p>
                    <h3 class="text-2xl font-bold text-white mt-1">{{ $antrianHariIni }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center">
                    <i data-lucide="activity" class="w-6 h-6"></i>
                </div>
            </div>
            <p class="text-[11px] text-blue-400 mt-3 flex items-center font-medium">
                <i data-lucide="clock" class="w-3 h-3 mr-1"></i> {{ $antrianMenunggu }} Menunggu / Diperiksa
            </p>
        </div>

        <div class="p-5 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl relative overflow-hidden group hover:border-teal-500/40 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pasien Selesai</p>
                    <h3 class="text-2xl font-bold text-white mt-1">{{ $antrianSelesai }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-400 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-6 h-6"></i>
                </div>
            </div>
            <p class="text-[11px] text-teal-400 mt-3 flex items-center font-medium">
                <i data-lucide="check" class="w-3 h-3 mr-1"></i> Pelayanan tuntas hari ini
            </p>
        </div>

        <div class="p-5 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/40 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pendapatan Kasir</p>
                    <h3 class="text-2xl font-bold text-amber-400 mt-1">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center">
                    <i data-lucide="wallet" class="w-6 h-6"></i>
                </div>
            </div>
            <p class="text-[11px] text-amber-400 mt-3 flex items-center font-medium">
                <i data-lucide="receipt" class="w-3 h-3 mr-1"></i> Transaksi lunas hari ini
            </p>
        </div>
    </div>

    <!-- Antrian Real-time Grid & Stock Alert -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Antrian Table -->
        <div class="lg:col-span-2 p-6 rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-white flex items-center">
                    <i data-lucide="list-ordered" class="w-4 h-4 mr-2 text-emerald-400"></i> Antrian Pelayanan Terkini
                </h3>
                <a href="/antrian" class="text-xs text-emerald-400 hover:underline">Buka Display Antrian →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="text-xs text-slate-400 uppercase bg-slate-900/60 border-b border-slate-700/50">
                        <tr>
                            <th class="px-4 py-3">No. Antrian</th>
                            <th class="px-4 py-3">Nama Pasien</th>
                            <th class="px-4 py-3">Poli Tujuan</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($antrianTerbaru as $antri)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-4 py-3 font-bold text-emerald-400">{{ $antri->nomor_antrian }}</td>
                            <td class="px-4 py-3 font-medium text-white">{{ $antri->pasien->nama_lengkap ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-400">{{ $antri->poli->nama_poli ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $antri->status === 'selesai' ? 'bg-teal-500/10 text-teal-400 border border-teal-500/20' : ($antri->status === 'dipanggil' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse' : 'bg-blue-500/10 text-blue-400 border border-blue-500/20') }}">
                                    {{ ucfirst($antri->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-slate-500">Belum ada antrian yang terdaftar hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Stok Obat Kritis -->
        <div class="p-6 rounded-2xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-white flex items-center">
                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-2 text-rose-400"></i> Peringatan Stok Obat
                    </h3>
                </div>

                <div class="space-y-3">
                    @forelse($obatKritis as $obat)
                    <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $obat->nama_obat }}</p>
                            <p class="text-xs text-rose-300">Sisa Stok: <strong class="font-bold">{{ $obat->stok }} {{ $obat->satuan }}</strong> (Min: {{ $obat->min_stok }})</p>
                        </div>
                        <a href="/farmasi" class="px-2.5 py-1 bg-rose-600 hover:bg-rose-500 text-white rounded-lg text-xs font-medium">Restock</a>
                    </div>
                    @empty
                    <div class="text-center py-6 text-slate-400 text-xs">
                        <i data-lucide="check-circle" class="w-8 h-8 text-emerald-400 mx-auto mb-2"></i>
                        Semua stok obat dalam kondisi aman dan mencukupi.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 p-4 rounded-xl bg-slate-900/60 border border-slate-800 text-xs text-slate-400">
                <p class="font-semibold text-slate-300 mb-1">Klinik Pratama PUSDIKZI</p>
                <p>Jl. Jenderal Sudirman No. 35, Pabaton, Bogor Tengah | IGD 24 Jam</p>
            </div>
        </div>
    </div>
</div>
