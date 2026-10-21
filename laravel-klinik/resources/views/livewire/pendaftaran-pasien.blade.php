<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2">
                <i data-lucide="user-plus" class="w-6 h-6 text-emerald-400"></i>
                Pendaftaran & Rekam Medis Pasien
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Registrasi pasien baru/lama dan penerbitan tiket antrean poli</p>
        </div>
    </div>

    @if ($alertSuccess)
        <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 flex items-center justify-between shadow-lg shadow-emerald-950/30">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </div>
                <span class="text-xs sm:text-sm font-semibold">{{ $alertSuccess }}</span>
            </div>
            <button wire:click="$set('alertSuccess', '')" class="text-xs text-slate-400 hover:text-white p-1">✕</button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Pendaftaran -->
        <div class="lg:col-span-2 p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-700/50 pb-4 mb-6 gap-3">
                <h3 class="text-base font-bold text-white flex items-center">
                    <i data-lucide="user-check" class="w-5 h-5 mr-2 text-emerald-400"></i> Form Data Pasien & Kunjungan
                </h3>
                <div class="flex space-x-2 self-start sm:self-auto">
                    <button type="button" wire:click="$set('isPasienBaru', false)" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ !$isPasienBaru ? 'bg-emerald-600 text-white' : 'bg-slate-700/50 text-slate-300' }}">Pasien Lama</button>
                    <button type="button" wire:click="$set('isPasienBaru', true)" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $isPasienBaru ? 'bg-emerald-600 text-white' : 'bg-slate-700/50 text-slate-300' }}">Pasien Baru</button>
                </div>
            </div>

            <form wire:submit.prevent="simpanPendaftaran" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Kategori Pasien</label>
                        <select wire:model.live="kategori_pasien" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                            <option value="Umum">Umum (Mandiri)</option>
                            <option value="Militer PUSDIKZI">Militer / Prajurit PUSDIKZI</option>
                            <option value="PNS / Keluarga">PNS / Keluarga Anggota</option>
                            <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">NIK (16 Digit KTP) / NRP</label>
                        <input type="text" wire:model="nik" placeholder="Masukkan 16 digit NIK..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                        @error('nik') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Lengkap Pasien</label>
                        <input type="text" wire:model="nama_lengkap" placeholder="Nama lengkap sesuai identitas..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                        @error('nama_lengkap') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Jenis Kelamin</label>
                        <select wire:model="jenis_kelamin" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Tanggal Lahir</label>
                        <input type="date" wire:model="tanggal_lahir" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">No. WhatsApp / HP</label>
                        <input type="text" wire:model="no_telepon" placeholder="08xxxxxxxxxx" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Alamat Lengkap</label>
                    <textarea wire:model="alamat" rows="2" placeholder="Alamat domisili pasien..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500"></textarea>
                </div>

                <div class="border-t border-slate-700/50 pt-4 mt-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-400 mb-3">Tujuan Poli & Pemeriksaan Awal (Triage)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1">Poli Tujuan *</label>
                            <select wire:model="poli_id" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-1">Dokter Praktek (Opsional)</label>
                            <select wire:model="dokter_id" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                                <option value="">-- Dokter Jaga Saat Ini --</option>
                                @foreach($dokters as $dok)
                                    <option value="{{ $dok->id }}">{{ $dok->nama_lengkap }} ({{ $dok->spesialisasi }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Keluhan Utama Pasien *</label>
                        <input type="text" wire:model="keluhan_utama" placeholder="Contoh: Demam 3 hari, batuk berdahak dan pusing..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                        @error('keluhan_utama') <span class="text-rose-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-400 mb-1">Tensi (mmHg)</label>
                            <input type="text" wire:model="tensi" placeholder="120/80" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-400 mb-1">Suhu (°C)</label>
                            <input type="text" wire:model="suhu" placeholder="36.5" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-400 mb-1">BB (Kg)</label>
                            <input type="text" wire:model="berat_badan" placeholder="65" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-400 mb-1">TB (cm)</label>
                            <input type="text" wire:model="tinggi_badan" placeholder="170" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold text-xs sm:text-sm transition flex items-center justify-center shadow-lg shadow-emerald-600/30">
                        <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Daftarkan Pasien & Cetak Tiket Antrian
                    </button>
                </div>
            </form>
        </div>

        <!-- Pencarian & Direktori Pasien Terdaftar -->
        <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-white mb-4 flex items-center">
                    <i data-lucide="search" class="w-4 h-4 mr-2 text-emerald-400"></i> Cari Pasien Terdaftar
                </h3>

                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari Nama / No RM / NIK..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white mb-4 focus:outline-none focus:border-emerald-500">

                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-1">
                    @forelse($pasiens as $pasien)
                    <div wire:click="pilihPasienLama({{ $pasien->id }})" class="p-3.5 rounded-xl bg-slate-900/60 border border-slate-800 hover:border-emerald-500/50 cursor-pointer transition flex items-center justify-between">
                        <div class="min-w-0 flex-1 mr-2">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-bold text-emerald-400 font-mono">{{ $pasien->no_rm }}</span>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-800 text-slate-300 truncate max-w-[110px]">{{ $pasien->kategori_pasien }}</span>
                            </div>
                            <p class="text-sm font-semibold text-white mt-1 truncate">{{ $pasien->nama_lengkap }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $pasien->alamat }}</p>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 text-slate-500 flex-shrink-0"></i>
                    </div>
                    @empty
                    <div class="text-center py-8 text-slate-500 text-xs">
                        Tidak ada pasien yang cocok dengan kata kunci.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-4">
                {{ $pasiens->links() }}
            </div>
        </div>
    </div>

    <!-- MODAL CETAK TIKET / STRUK ANTREAN POLI -->
    @if ($showTiketModal && $lastAntrian)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-md overflow-y-auto" x-cloak>
        <div class="relative w-full max-w-sm bg-white text-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 my-auto printable-receipt">
            
            <!-- Header (Hidden when printed) -->
            <div class="bg-slate-900 text-white px-5 py-3.5 flex items-center justify-between no-print">
                <div class="flex items-center gap-2">
                    <i data-lucide="ticket" class="w-4 h-4 text-emerald-400"></i>
                    <span class="text-xs font-bold uppercase tracking-wider">Tiket Antrean Pasien</span>
                </div>
                <button wire:click="closeTiket" class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- THERMAL TICKET SLIP CONTENT -->
            <div class="p-6 font-sans text-center space-y-4">
                <!-- Clinic Header -->
                <div class="space-y-1 border-b border-dashed border-slate-300 pb-3">
                    <h2 class="text-xs font-black tracking-wider text-slate-900 uppercase">KLINIK PRATAMA PUSDIKZI</h2>
                    <p class="text-[10px] text-slate-600 font-semibold">ZENI TNI ANGKATAN DARAT BOGOR</p>
                    <p class="text-[9px] text-slate-500">Jl. Jenderal Sudirman No. 35 | Telp: (0251) 832-1234</p>
                </div>

                <!-- Poli & Queue Big Number -->
                <div class="py-2 space-y-1">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                        {{ $lastAntrian->poli->nama_poli ?? 'POLI UMUM' }}
                    </span>
                    <div class="text-5xl font-black text-slate-900 font-mono tracking-tight py-2">
                        {{ $lastAntrian->nomor_antrian }}
                    </div>
                    <p class="text-xs font-bold text-slate-800">{{ $lastAntrian->pasien->nama_lengkap ?? '-' }}</p>
                    <p class="text-[11px] text-slate-500">No. RM: <strong class="font-mono text-slate-800">{{ $lastAntrian->pasien->no_rm ?? '-' }}</strong></p>
                </div>

                <!-- Info Box -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-[10px] text-slate-600 space-y-1 text-left">
                    <div class="flex justify-between">
                        <span>Waktu Daftar:</span>
                        <strong class="text-slate-800">{{ $lastAntrian->waktu_daftar ? \Carbon\Carbon::parse($lastAntrian->waktu_daftar)->format('d/m/Y H:i') : date('d/m/Y H:i') }} WIB</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Kategori Pasien:</span>
                        <strong class="text-slate-800">{{ $lastAntrian->pasien->kategori_pasien ?? '-' }}</strong>
                    </div>
                    @if($lastAntrian->dokter)
                    <div class="flex justify-between">
                        <span>Dokter Jaga:</span>
                        <strong class="text-slate-800">{{ $lastAntrian->dokter->nama_lengkap }}</strong>
                    </div>
                    @endif
                </div>

                <!-- Barcode & Note -->
                <div class="border-t border-dashed border-slate-300 pt-3 space-y-1">
                    <div class="font-mono text-[9px] tracking-[0.25em] text-slate-400">|||| ||| |||||| |||| | |||||</div>
                    <p class="text-[9px] text-slate-500 italic">
                        *Harap menunggu di ruang tunggu poli. Pantau layar display antrean.*
                    </p>
                </div>
            </div>

            <!-- Action Buttons (Hidden when printed) -->
            <div class="bg-slate-100 p-4 border-t border-slate-200 flex flex-col sm:flex-row gap-2.5 no-print">
                <button type="button" onclick="window.print()" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-md transition">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak Tiket (Print)</span>
                </button>
                <button type="button" wire:click="closeTiket" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs transition text-center">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
