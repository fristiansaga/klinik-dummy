<div class="space-y-6">
    <!-- Top Header Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-white flex items-center gap-2">
                Digital Health Passport & Rekam Pasien 🪪
            </h1>
            <p class="text-xs text-slate-400">Identitas Terpadu, Riwayat Penyakit, dan Rujukan Terintegrasi SATUSEHAT Kemenkes RI.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <button type="button" @click="$dispatch('open-wa-modal', 'antrean')" class="bg-[#075E54] hover:bg-[#128C7E] text-white text-xs font-bold px-3.5 py-2 rounded-xl flex items-center gap-1.5 shadow-lg shadow-emerald-950/30 transition">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Notifikasi WhatsApp</span>
            </button>

            <button wire:click="cetakRiwayat" class="bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold px-3.5 py-2 rounded-xl flex items-center gap-1.5 shadow-md transition">
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>Cetak Riwayat Penyakit</span>
            </button>

            <button onclick="window.print()" class="bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 text-xs font-medium px-3.5 py-2 rounded-xl flex items-center gap-1.5 transition">
                <i data-lucide="credit-card" class="w-4 h-4"></i>
                <span>Cetak Kartu</span>
            </button>
        </div>
    </div>

    <!-- Sliced Component: Health Passport Card -->
    <x-health-passport-card :patient="$patient" />

    <!-- Navigation Tabs -->
    <div class="flex border-b border-slate-800 space-x-2 text-xs sm:text-sm font-medium overflow-x-auto pb-1">
        <button wire:click="setTab('passport')" class="px-3.5 sm:px-4 py-2 rounded-xl transition flex items-center gap-1.5 whitespace-nowrap {{ $activeTab === 'passport' ? 'bg-emerald-600 text-white font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <i data-lucide="activity" class="w-4 h-4"></i>
            <span>Ringkasan & Lab</span>
        </button>

        <button wire:click="setTab('riwayat')" class="px-3.5 sm:px-4 py-2 rounded-xl transition flex items-center gap-1.5 whitespace-nowrap {{ $activeTab === 'riwayat' ? 'bg-emerald-600 text-white font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <i data-lucide="file-text" class="w-4 h-4"></i>
            <span>Riwayat Penyakit ({{ count($riwayatMedis) }})</span>
        </button>

        <button wire:click="setTab('rujukan')" class="px-3.5 sm:px-4 py-2 rounded-xl transition flex items-center gap-1.5 whitespace-nowrap {{ $activeTab === 'rujukan' ? 'bg-emerald-600 text-white font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <i data-lucide="send" class="w-4 h-4"></i>
            <span>Surat Rujukan Medis</span>
        </button>

        <button wire:click="setTab('booking')" class="px-3.5 sm:px-4 py-2 rounded-xl transition flex items-center gap-1.5 whitespace-nowrap {{ $activeTab === 'booking' ? 'bg-emerald-600 text-white font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <i data-lucide="calendar-plus" class="w-4 h-4"></i>
            <span>Booking Kunjungan</span>
        </button>

        <button wire:click="setTab('antrean')" class="px-3.5 sm:px-4 py-2 rounded-xl transition flex items-center gap-1.5 whitespace-nowrap {{ $activeTab === 'antrean' ? 'bg-emerald-600 text-white font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
            <i data-lucide="clock" class="w-4 h-4"></i>
            <span>Live Antrean</span>
        </button>
    </div>

    <!-- Tab 1: Ringkasan & POCT Lab -->
    @if($activeTab === 'passport')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Hasil Lab POCT Cepat -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i data-lucide="flask-conical" class="w-4 h-4 text-emerald-400"></i>
                    Hasil Lab Cepat (POCT Terakhir)
                </h3>
                <span class="text-[10px] bg-emerald-500/20 text-emerald-300 px-2 py-0.5 rounded-full font-bold">30 Agu 2026</span>
            </div>

            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-slate-950/60 border border-slate-800 rounded-xl p-3">
                    <span class="text-[11px] text-slate-400 block mb-1">Gula Darah (GDS)</span>
                    <strong class="text-xl font-extrabold text-emerald-400">110</strong>
                    <span class="text-[10px] text-emerald-500 block">mg/dL (Normal)</span>
                </div>

                <div class="bg-slate-950/60 border border-slate-800 rounded-xl p-3">
                    <span class="text-[11px] text-slate-400 block mb-1">Kolesterol</span>
                    <strong class="text-xl font-extrabold text-emerald-400">175</strong>
                    <span class="text-[10px] text-emerald-500 block">mg/dL (Normal)</span>
                </div>

                <div class="bg-slate-950/60 border border-slate-800 rounded-xl p-3">
                    <span class="text-[11px] text-slate-400 block mb-1">Asam Urat</span>
                    <strong class="text-xl font-extrabold text-emerald-400">5.4</strong>
                    <span class="text-[10px] text-emerald-500 block">mg/dL (Normal)</span>
                </div>
            </div>
        </div>

        <!-- Surat Medis & Izin Dokter -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4 text-amber-400"></i>
                    Surat Keterangan Dokter Saya
                </h3>
                <span class="text-[10px] bg-amber-500/20 text-amber-300 px-2 py-0.5 rounded-full font-bold">Tersedia</span>
            </div>

            <div class="bg-slate-950/60 border border-slate-800 rounded-xl p-3.5 flex items-center justify-between">
                <div>
                    <h4 class="text-xs font-bold text-white">Surat Keterangan Sakit (2 Hari)</h4>
                    <p class="text-[11px] text-slate-400">dr. Agus Susanto, Sp.PD • 30 Agu 2026</p>
                </div>
                <button onclick="window.print()" class="bg-slate-800 hover:bg-slate-700 text-xs text-white px-3 py-1.5 rounded-lg flex items-center gap-1">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i> Cetak
                </button>
            </div>
            <p class="text-[10px] text-slate-500">*Diverifikasi tanda tangan elektronik resmi SATUSEHAT Kemenkes RI.</p>
        </div>
    </div>
    @endif

    <!-- Tab: RIWAYAT PENYAKIT & RESUME MEDIS -->
    @if($activeTab === 'riwayat')
    <div class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-slate-900/80 border border-slate-800 p-4 rounded-2xl gap-3">
            <div>
                <h3 class="text-base font-bold text-white flex items-center gap-2">
                    <i data-lucide="history" class="w-5 h-5 text-emerald-400"></i>
                    Kronologi Riwayat Penyakit & Pemeriksaan Medis
                </h3>
                <p class="text-xs text-slate-400">Arsip riwayat kunjungan, diagnosa ICD-10, tanda vital, dan terapi obat pasien</p>
            </div>
            <button wire:click="cetakRiwayat" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold flex items-center gap-2 self-start sm:self-auto shadow-md transition">
                <i data-lucide="printer" class="w-4 h-4"></i> Cetak Lembar Riwayat Medis (PDF)
            </button>
        </div>

        <div class="space-y-3">
            @foreach($riwayatMedis as $item)
            <div class="bg-slate-900/90 border border-slate-800 hover:border-emerald-500/40 rounded-2xl p-5 space-y-3 transition">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-2.5 gap-1.5">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-mono font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20">{{ $item['tanggal'] }}</span>
                        <span class="text-xs font-semibold text-white">• {{ $item['poli'] }}</span>
                        <span class="text-[11px] text-slate-400">({{ $item['dokter'] }})</span>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-800 text-emerald-300 font-semibold self-start sm:self-auto">
                        {{ $item['status'] }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                    <div>
                        <span class="text-slate-400 block text-[11px] font-semibold">Keluhan Pasien:</span>
                        <p class="text-slate-200 mt-0.5 italic">"{{ $item['keluhan'] }}"</p>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px] font-semibold">Diagnosa Klinis (ICD-10):</span>
                        <p class="text-emerald-400 font-bold mt-0.5">{{ $item['diagnosa'] }} <span class="text-slate-400 font-mono font-normal">({{ $item['icd10'] }})</span></p>
                    </div>
                </div>

                <div class="bg-slate-950/60 p-3 rounded-xl border border-slate-800/80 text-xs space-y-1">
                    <div class="flex flex-wrap gap-x-4 text-[11px] text-slate-300">
                        <span><strong>Tanda Vital:</strong> {{ $item['vital_sign'] }}</span>
                    </div>
                    @if($item['lab'] !== '-')
                    <div class="text-[11px] text-emerald-400">
                        <strong>Laboratorium POCT:</strong> {{ $item['lab'] }}
                    </div>
                    @endif
                    <div class="text-[11px] text-slate-300">
                        <strong>Terapi & Resep Obat:</strong> {{ $item['terapi'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Tab: SURAT RUJUKAN MEDIS -->
    @if($activeTab === 'rujukan')
    <div class="space-y-4">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 sm:p-6 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-800 pb-4 gap-3">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 text-[10px] font-bold">
                            SURAT RUJUKAN RESMI AKTIF
                        </span>
                        <span class="font-mono text-xs text-slate-400">{{ $suratRujukan['no_rujukan'] }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white">Rujukan Faskes Lanjutan: {{ $suratRujukan['faskes_tujuan'] }}</h3>
                    <p class="text-xs text-slate-400">Tujuan Poli: <strong class="text-emerald-400">{{ $suratRujukan['poli_tujuan'] }}</strong></p>
                </div>
                <button wire:click="cetakRujukan" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold flex items-center gap-2 self-start sm:self-auto shadow-lg shadow-emerald-600/30 transition">
                    <i data-lucide="printer" class="w-4 h-4"></i> Cetak Surat Rujukan
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                <div class="bg-slate-950/60 p-4 rounded-xl border border-slate-800 space-y-2">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-400">Informasi Rujukan</span>
                    <div class="space-y-1 text-slate-300">
                        <div class="flex justify-between"><span>Faskes Perujuk:</span><strong class="text-white">{{ $suratRujukan['faskes_perujuk'] }}</strong></div>
                        <div class="flex justify-between"><span>Tanggal Terbit:</span><span>{{ $suratRujukan['tgl_rujukan'] }}</span></div>
                        <div class="flex justify-between"><span>Masa Berlaku:</span><span class="text-amber-400 font-semibold">{{ $suratRujukan['berlaku_sampai'] }}</span></div>
                        <div class="flex justify-between"><span>Dokter Perujuk:</span><span>{{ $suratRujukan['dokter_perujuk'] }}</span></div>
                    </div>
                </div>

                <div class="bg-slate-950/60 p-4 rounded-xl border border-slate-800 space-y-2">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-400">Diagnosa & Alasan Rujuk</span>
                    <div class="space-y-1.5 text-slate-300">
                        <div>
                            <span class="text-slate-400 block text-[10px]">Diagnosa Rujukan:</span>
                            <strong class="text-emerald-300">{{ $suratRujukan['diagnosa_utama'] }}</strong>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px]">Alasan Rujukan / Tindakan Lanjutan:</span>
                            <p class="text-slate-200 italic">{{ $suratRujukan['alasan_rujuk'] }}</p>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px]">Terapi Sementara Saat Dirujuk:</span>
                            <p class="text-slate-200">{{ $suratRujukan['terapi_sementara'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3.5 bg-emerald-500/10 border border-emerald-500/30 rounded-xl text-xs text-emerald-300 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                    <span>Status Verifikasi: <strong>Tervalidasi Digital BPJS Kesehatan & SATUSEHAT RI</strong></span>
                </div>
                <span class="font-mono text-[11px] text-emerald-400">TTE-VALID</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Tab 2: Booking Form -->
    @if($activeTab === 'booking')
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 max-w-2xl">
        <form wire:submit.prevent="submitBooking" class="space-y-4">
            <div>
                <label class="text-xs font-bold text-slate-300 block mb-1.5">Pilih Poliklinik Layanan</label>
                <select wire:model="poliTujuan" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white outline-none focus:border-emerald-500">
                    <option value="Poli Umum">Poli Umum & Medical Check Up</option>
                    <option value="Poli Penyakit Dalam">Poli Penyakit Dalam (Sp.PD)</option>
                    <option value="Poli Gigi">Poli Gigi & Mulut</option>
                    <option value="Poli KIA">Poli KIA & Kebidanan</option>
                </select>
            </div>

            <div>
                <label class="text-xs font-bold text-slate-300 block mb-1.5">Pilih Dokter Praktik</label>
                <select wire:model="dokterTujuan" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white outline-none focus:border-emerald-500">
                    <option value="dr. Agus Susanto, Sp.PD">dr. Agus Susanto, Sp.PD (08:00 - 13:00)</option>
                    <option value="dr. Siti Rahmawati">dr. Siti Rahmawati (13:00 - 18:00)</option>
                    <option value="drg. Budi Santoso">drg. Budi Santoso (09:00 - 15:00)</option>
                </select>
            </div>

            <div>
                <label class="text-xs font-bold text-slate-300 block mb-1.5">Keluhan Utama / Gejala</label>
                <textarea wire:model="keluhan" rows="3" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2.5 text-xs text-white outline-none focus:border-emerald-500" placeholder="Tuliskan gejala yang dirasakan..."></textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 rounded-xl text-xs flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/30 transition">
                <i data-lucide="check" class="w-4 h-4"></i> Konfirmasi Booking Antrean
            </button>
        </form>
    </div>
    @endif

    <!-- Tab 3: Live Antrean -->
    @if($activeTab === 'antrean')
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 text-center max-w-md mx-auto space-y-4">
        <span class="text-xs text-slate-400 uppercase font-bold tracking-wider">Tiket Antrean Anda Hari Ini</span>
        <h2 class="text-5xl font-black text-emerald-400 my-2">{{ $patient['antrean_hari_ini'] }}</h2>
        <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs py-2 px-3 rounded-xl font-medium">
            {{ $patient['poli_antrean'] }} • Menunggu {{ $patient['sisa_antrean'] }} Pasien Lagi
        </div>
        <p class="text-xs text-slate-400">Harap standby di ruang tunggu poli 15 menit sebelum estimasi giliran.</p>
    </div>
    @endif

    <!-- MODAL CETAK: RESUME RIWAYAT PENYAKIT (A4 / PDF) -->
    @if($showPrintModal && $printType === 'riwayat')
    <div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-md overflow-y-auto" x-cloak>
        <div class="relative w-full max-w-2xl bg-white text-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 my-auto printable-receipt">
            <!-- Modal Header -->
            <div class="bg-slate-900 text-white px-5 py-3.5 flex items-center justify-between no-print">
                <div class="flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4 text-emerald-400"></i>
                    <span class="text-xs font-bold uppercase tracking-wider">Preview Resume Riwayat Medis Pasien</span>
                </div>
                <button wire:click="closePrintModal" class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- DOCUMENT PRINT CONTENT -->
            <div class="p-6 sm:p-8 font-sans text-xs space-y-4">
                <!-- KOP Surat Resmi -->
                <div class="border-b-2 border-slate-900 pb-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-emerald-900 text-white flex items-center justify-center font-bold">
                            <i data-lucide="cross" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-black tracking-wide uppercase text-slate-900">KLINIK PRATAMA PUSDIKZI</h2>
                            <p class="text-[11px] font-bold text-emerald-800">PUSAT PENDIDIKAN ZENI TNI ANGKATAN DARAT</p>
                            <p class="text-[10px] text-slate-600">Jl. Jenderal Sudirman No. 35, Bogor Tengah | Telp: (0251) 832-1234</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] bg-slate-100 border border-slate-300 px-2 py-1 rounded font-bold">SATUSEHAT: 0115B001</span>
                    </div>
                </div>

                <div class="text-center py-1">
                    <h3 class="text-sm font-black uppercase tracking-wider text-slate-900">RESUME RIWAYAT KESEHATAN PASIEN</h3>
                    <p class="text-[10px] text-slate-500">Nomor Rekam Medis: <strong class="font-mono text-slate-900">{{ $patient['no_rm'] }}</strong></p>
                </div>

                <!-- Info Pasien Grid -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-[11px] grid grid-cols-2 gap-2 text-slate-800">
                    <div><span>Nama Pasien:</span> <strong class="text-slate-900">{{ $patient['nama'] }}</strong></div>
                    <div><span>NIK / NRP:</span> <strong class="font-mono">{{ $patient['nik'] }}</strong></div>
                    <div><span>Penjamin:</span> <strong>{{ $patient['penjamin'] }} ({{ $patient['bpjs'] }})</strong></div>
                    <div><span>Gol. Darah / Tgl Lahir:</span> <strong>{{ $patient['gol_darah'] }} / {{ $patient['tgl_lahir'] }}</strong></div>
                    <div class="col-span-2 text-rose-700 font-semibold"><span>Riwayat Alergi:</span> {{ $patient['alergi'] }}</div>
                </div>

                <!-- Kronologi Table -->
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-900 uppercase">Kronologi Riwayat Pemeriksaan & Diagnosa</span>
                    <div class="border border-slate-300 rounded-xl overflow-hidden">
                        <table class="w-full text-left text-[11px]">
                            <thead class="bg-slate-100 border-b border-slate-300 text-slate-700 font-bold uppercase text-[10px]">
                                <tr>
                                    <th class="p-2">Tanggal / Poli</th>
                                    <th class="p-2">Diagnosa (ICD-10)</th>
                                    <th class="p-2">Tanda Vital & Lab</th>
                                    <th class="p-2">Terapi Obat</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach($riwayatMedis as $rw)
                                <tr>
                                    <td class="p-2 align-top">
                                        <strong>{{ $rw['tanggal'] }}</strong><br/>
                                        <span class="text-slate-500 text-[10px]">{{ $rw['poli'] }}</span>
                                    </td>
                                    <td class="p-2 align-top">
                                        <strong class="text-emerald-900">{{ $rw['diagnosa'] }}</strong><br/>
                                        <span class="font-mono text-[10px] text-slate-500">({{ $rw['icd10'] }})</span>
                                    </td>
                                    <td class="p-2 align-top text-[10px]">
                                        {{ $rw['vital_sign'] }}<br/>
                                        @if($rw['lab'] !== '-') <span class="text-emerald-800">Lab: {{ $rw['lab'] }}</span> @endif
                                    </td>
                                    <td class="p-2 align-top text-[10px] text-slate-700">
                                        {{ $rw['terapi'] }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TTE Footer -->
                <div class="pt-4 flex justify-between items-end border-t border-slate-200 text-[11px]">
                    <div class="text-[9px] text-slate-500 space-y-1">
                        <p>Dokumen ini diterbitkan sah secara elektronik oleh Sistem Informasi Klinik Pratama PUSDIKZI.</p>
                        <p class="font-mono">Verifikasi TTE SATUSEHAT: PZ-MED-2026-OK</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] text-slate-600">Bogor, {{ date('d F Y') }}</p>
                        <p class="text-[10px] font-bold text-slate-800">Dokter Penanggung Jawab Pelayanan,</p>
                        <div class="my-2 font-mono text-[9px] text-emerald-800">[ TTE Tervalidasi ]</div>
                        <p class="font-bold text-slate-900">dr. Agus Susanto, Sp.PD</p>
                        <p class="text-[9px] text-slate-500">SIP: 446.1/082/SIP-D/2024</p>
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="bg-slate-100 p-4 border-t border-slate-200 flex flex-col sm:flex-row gap-2.5 no-print">
                <button type="button" onclick="window.print()" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-md transition">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak Lembar Riwayat (Print / PDF)</span>
                </button>
                <button type="button" wire:click="closePrintModal" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs transition text-center">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- MODAL CETAK: SURAT RUJUKAN FKTP (A4 / PDF) -->
    @if($showPrintModal && $printType === 'rujukan')
    <div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-md overflow-y-auto" x-cloak>
        <div class="relative w-full max-w-2xl bg-white text-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 my-auto printable-receipt">
            <!-- Modal Header -->
            <div class="bg-slate-900 text-white px-5 py-3.5 flex items-center justify-between no-print">
                <div class="flex items-center gap-2">
                    <i data-lucide="send" class="w-4 h-4 text-emerald-400"></i>
                    <span class="text-xs font-bold uppercase tracking-wider">Preview Surat Rujukan Pasien (FKTP)</span>
                </div>
                <button wire:click="closePrintModal" class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- DOCUMENT PRINT CONTENT -->
            <div class="p-6 sm:p-8 font-sans text-xs space-y-4">
                <!-- KOP Surat Resmi -->
                <div class="border-b-2 border-slate-900 pb-3 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-emerald-900 text-white flex items-center justify-center font-bold">
                            <i data-lucide="cross" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-black tracking-wide uppercase text-slate-900">KLINIK PRATAMA PUSDIKZI</h2>
                            <p class="text-[11px] font-bold text-emerald-800">PUSAT PENDIDIKAN ZENI TNI ANGKATAN DARAT</p>
                            <p class="text-[10px] text-slate-600">Jl. Jenderal Sudirman No. 35, Bogor Tengah | Telp: (0251) 832-1234</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 border border-emerald-300 px-2 py-1 rounded font-bold font-mono">{{ $suratRujukan['no_rujukan'] }}</span>
                    </div>
                </div>

                <div class="text-center py-1">
                    <h3 class="text-sm font-black uppercase tracking-wider text-slate-900">SURAT RUJUKAN PASIEN RAWAT JALAN</h3>
                    <p class="text-[10px] text-slate-500">Standar Pelayanan Kesehatan Rujukan Berjenjang BPJS Kesehatan & SATUSEHAT</p>
                </div>

                <!-- Kepada Yth / RS Tujuan -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-[11px] text-slate-800 space-y-1">
                    <p>Kepada Yth. <strong>Dokter Spesialis {{ $suratRujukan['poli_tujuan'] }}</strong></p>
                    <p>Fasilitas Pelayanan Kesehatan Rujukan Tingkat Lanjutan (FKRTL):</p>
                    <p class="text-base font-black text-emerald-900">{{ $suratRujukan['faskes_tujuan'] }}</p>
                </div>

                <!-- Data Pasien -->
                <div class="space-y-1.5 text-[11px] border border-slate-200 rounded-xl p-3">
                    <p class="font-bold text-slate-900 uppercase text-[10px]">Identitas Pasien yang Dirujuk:</p>
                    <div class="grid grid-cols-2 gap-2 text-slate-700">
                        <div>Nama: <strong class="text-slate-900">{{ $patient['nama'] }}</strong></div>
                        <div>No. Rekam Medis: <strong class="font-mono">{{ $patient['no_rm'] }}</strong></div>
                        <div>No. Kartu BPJS / NIK: <strong class="font-mono">{{ $patient['bpjs'] }} / {{ $patient['nik'] }}</strong></div>
                        <div>Tgl Lahir / Jenis Kelamin: <strong>{{ $patient['tgl_lahir'] }} / Laki-laki</strong></div>
                    </div>
                </div>

                <!-- Rincian Klinis Rujukan -->
                <div class="space-y-2 text-[11px] bg-slate-50 border border-slate-200 rounded-xl p-3 text-slate-800">
                    <div>
                        <span class="text-slate-500 block text-[10px]">Diagnosa Rujukan (ICD-10):</span>
                        <strong class="text-sm text-emerald-900">{{ $suratRujukan['diagnosa_utama'] }}</strong>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[10px]">Alasan Rujukan / Permintaan Tindakan:</span>
                        <p class="text-slate-800 italic">{{ $suratRujukan['alasan_rujuk'] }}</p>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[10px]">Terapi / Pengobatan yang Telah Diberikan:</span>
                        <p class="text-slate-800">{{ $suratRujukan['terapi_sementara'] }}</p>
                    </div>
                </div>

                <!-- Masa Berlaku & TTE -->
                <div class="pt-3 flex justify-between items-end border-t border-slate-200 text-[11px]">
                    <div class="text-[9px] text-slate-500 space-y-1">
                        <p><strong>Masa Berlaku Rujukan:</strong> {{ $suratRujukan['berlaku_sampai'] }}</p>
                        <p>Bawalah surat rujukan ini beserta KTP & Kartu BPJS/Asuransi saat berobat ke RS Rujukan.</p>
                        <div class="font-mono text-[9px] tracking-[0.2em] text-slate-400">|||| ||| |||||| |||| | |||||</div>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] text-slate-600">Bogor, {{ $suratRujukan['tgl_rujukan'] }}</p>
                        <p class="text-[10px] font-bold text-slate-800">Dokter Pengirim / Perujuk,</p>
                        <div class="my-2 font-mono text-[9px] text-emerald-800">[ TTE Tervalidasi SATUSEHAT ]</div>
                        <p class="font-bold text-slate-900">{{ $suratRujukan['dokter_perujuk'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="bg-slate-100 p-4 border-t border-slate-200 flex flex-col sm:flex-row gap-2.5 no-print">
                <button type="button" onclick="window.print()" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-md transition">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak Surat Rujukan (Print / PDF)</span>
                </button>
                <button type="button" wire:click="closePrintModal" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs transition text-center">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Sliced Component: WhatsApp Modal Simulator -->
    <x-wa-simulator-modal />
</div>
