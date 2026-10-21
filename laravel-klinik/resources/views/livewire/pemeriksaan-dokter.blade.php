<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2">
                <i data-lucide="stethoscope" class="w-6 h-6 text-emerald-400"></i>
                Pemeriksaan Dokter & E-Rekam Medis (SOAP)
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Standar Rekam Medis Elektronik Terintegrasi ICD-10, ICD-9 CM & e-Resep</p>
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
        <!-- Antrian Pasien Menunggu Pemeriksaan -->
        <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm sm:text-base font-bold text-white flex items-center">
                        <i data-lucide="users" class="w-4 h-4 mr-2 text-emerald-400"></i> Antrian Menunggu Dokter
                    </h3>
                    <span class="text-xs bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-0.5 rounded-full font-semibold">
                        {{ count($antrianAktif) }} Siap
                    </span>
                </div>

                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-1">
                    @forelse($antrianAktif as $item)
                    <div wire:click="selectAntrian({{ $item->id }})" class="p-4 rounded-xl {{ $selectedAntrianId == $item->id ? 'bg-emerald-600/20 border-emerald-500 shadow-lg shadow-emerald-600/20' : 'bg-slate-900/60 border-slate-800' }} border hover:border-emerald-500/50 cursor-pointer transition">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 font-mono">{{ $item->nomor_antrian }}</span>
                            <span class="text-[10px] text-slate-400">{{ $item->poli->nama_poli }}</span>
                        </div>
                        <h4 class="font-bold text-white text-sm mt-2 truncate">{{ $item->pasien->nama_lengkap }}</h4>
                        <p class="text-xs text-slate-300 mt-1 italic line-clamp-2">"{{ $item->keluhan_utama }}"</p>
                        <div class="mt-2 flex space-x-3 text-[11px] text-slate-400">
                            <span>TD: {{ $item->tensi ?? '120/80' }}</span>
                            <span>Suhu: {{ $item->suhu ?? '36.5' }}°C</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 text-slate-500">
                        <i data-lucide="check-circle" class="w-10 h-10 mx-auto mb-2 text-slate-600"></i>
                        <p class="text-xs">Belum ada pasien yang siap diperiksa.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Form SOAP & e-Resep -->
        <div class="lg:col-span-2 p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl">
            @if ($currentAntrian)
            <form wire:submit.prevent="simpanPemeriksaan" class="space-y-6">
                <!-- Patient Info Header -->
                <div class="p-4 rounded-xl bg-slate-900/80 border border-slate-700/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="text-xs text-emerald-400 font-bold font-mono">No. RM: {{ $currentAntrian->pasien->no_rm }}</span>
                        <h3 class="text-base font-bold text-white">{{ $currentAntrian->pasien->nama_lengkap }}</h3>
                        <p class="text-xs text-slate-400">{{ $currentAntrian->pasien->kategori_pasien }} | {{ $currentAntrian->pasien->umur }}</p>
                    </div>
                    <span class="self-start sm:self-auto text-lg font-black text-emerald-400 bg-emerald-500/10 px-3.5 py-1.5 rounded-xl border border-emerald-500/30 font-mono">
                        {{ $currentAntrian->nomor_antrian }}
                    </span>
                </div>

                <!-- S: Subjektif (Anamnesis) -->
                <div>
                    <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1">[S] Subjektif (Anamnesis & Keluhan Pasien)</label>
                    <textarea wire:model="subjektif" rows="2" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500" placeholder="Keluhan utama, riwayat penyakit sekarang..."></textarea>
                </div>

                <!-- O: Objektif (Pemeriksaan Fisik & Vital Sign) -->
                <div>
                    <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1">[O] Objektif (Tanda Vital & Pemeriksaan Fisik)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-2">
                        <div>
                            <span class="text-[10px] text-slate-400">Tekanan Darah</span>
                            <input type="text" wire:model="tekanan_darah" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2.5 py-1.5 text-xs text-white">
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400">Suhu (°C)</span>
                            <input type="text" wire:model="suhu" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2.5 py-1.5 text-xs text-white">
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400">Nadi (x/mnt)</span>
                            <input type="text" wire:model="nadi" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2.5 py-1.5 text-xs text-white">
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400">Pernapasan (x/mnt)</span>
                            <input type="text" wire:model="pernapasan" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2.5 py-1.5 text-xs text-white">
                        </div>
                    </div>

                    <!-- POCT Rapid Diagnostics -->
                    <div class="bg-slate-950/60 border border-slate-700/80 rounded-xl p-3 mb-2">
                        <span class="text-[11px] font-bold text-emerald-400 flex items-center gap-1 mb-2">
                            <i data-lucide="flask-conical" class="w-3.5 h-3.5"></i> Hasil Lab Cepat (POCT Di Ruang Dokter)
                        </span>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
                            <div>
                                <span class="text-[10px] text-slate-400">GDS (mg/dL)</span>
                                <input type="number" wire:model="gds" placeholder="e.g. 110" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2 py-1 text-xs text-white">
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400">Kolesterol (mg/dL)</span>
                                <input type="number" wire:model="kolesterol" placeholder="e.g. 175" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2 py-1 text-xs text-white">
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400">Asam Urat (mg/dL)</span>
                                <input type="number" step="0.1" wire:model="asamUrat" placeholder="e.g. 5.4" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2 py-1 text-xs text-white">
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400">Hb (g/dL)</span>
                                <input type="number" step="0.1" wire:model="hb" placeholder="e.g. 14.2" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-2 py-1 text-xs text-white">
                            </div>
                        </div>
                    </div>

                    <textarea wire:model="objektif" rows="2" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500" placeholder="Hasil pemeriksaan fisik head to toe..."></textarea>
                </div>

                <!-- A: Asesmen & Diagnosa ICD-10 -->
                <div>
                    <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1">[A] Asesmen & Diagnosa (Standar ICD-10)</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div>
                            <span class="text-[10px] text-slate-400">Kode ICD-10</span>
                            <input type="text" wire:model="kode_icd10" placeholder="e.g. I10, E11, J00" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white">
                        </div>
                        <div class="md:col-span-2">
                            <span class="text-[10px] text-slate-400">Nama Diagnosa Klinis</span>
                            <input type="text" wire:model="nama_diagnosa" placeholder="Nama diagnosa..." class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-xs text-white">
                        </div>
                    </div>
                </div>

                <!-- P: Plan / Terapi & e-Resep -->
                <div>
                    <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1">[P] Plan & Resep Elektronik (e-Prescription)</label>
                    
                    <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-700 space-y-3">
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
                            <div class="sm:col-span-2">
                                <select wire:model="selectedObatId" class="w-full bg-slate-800 border border-slate-600 rounded-lg px-2.5 py-2 text-xs text-white">
                                    <option value="">-- Pilih Obat / Resep --</option>
                                    @foreach($daftarObat as $obat)
                                        <option value="{{ $obat->id }}">
                                            {{ $obat->nama_obat }} @if($obat->merek && $obat->merek !== '-') [Merek: {{ $obat->merek }} - {{ $obat->produsen }}] @endif (Stok: {{ $obat->stok }}) - Rp {{ number_format($obat->harga_jual) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="number" wire:model="obatJumlah" placeholder="Jumlah" class="w-full bg-slate-800 border border-slate-600 rounded-lg px-2.5 py-2 text-xs text-white">
                            </div>
                            <div>
                                <button type="button" wire:click="tambahObatResep" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg px-2 py-2 text-xs font-bold">
                                    + Tambah Obat
                                </button>
                            </div>
                        </div>

                        <!-- Resep Items List -->
                        @if(count($resepItems) > 0)
                        <div class="divide-y divide-slate-800">
                            @foreach($resepItems as $index => $r)
                            <div class="py-2 flex items-center justify-between text-xs">
                                <div>
                                    <span class="font-bold text-white">{{ $r['nama_obat'] }}</span>
                                    <span class="text-slate-400 ml-2">({{ $r['jumlah'] }} unit) - {{ $r['aturan_pakai'] }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-emerald-400 font-semibold font-mono">Rp {{ number_format($r['total_harga']) }}</span>
                                    <button type="button" wire:click="hapusObatResep({{ $index }})" class="text-rose-400 hover:text-rose-300 p-1">✕</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Tindak Lanjut & Status Pelayanan (Rujukan Form) -->
                <div class="border-t border-slate-700/50 pt-4 space-y-3">
                    <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1">Tindak Lanjut & Status Pelayanan</label>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="p-3 rounded-xl border {{ $status_pelayanan === 'selesai' ? 'bg-emerald-600/20 border-emerald-500 text-white' : 'bg-slate-900 border-slate-700 text-slate-400' }} cursor-pointer flex items-center gap-2">
                            <input type="radio" wire:model.live="status_pelayanan" value="selesai" class="text-emerald-500">
                            <span class="text-xs font-bold">1. Selesai Rawat Jalan</span>
                        </label>
                        
                        <label class="p-3 rounded-xl border {{ $status_pelayanan === 'rujuk' ? 'bg-amber-600/20 border-amber-500 text-white' : 'bg-slate-900 border-slate-700 text-slate-400' }} cursor-pointer flex items-center gap-2">
                            <input type="radio" wire:model.live="status_pelayanan" value="rujuk" class="text-amber-500">
                            <span class="text-xs font-bold">2. Rujuk ke Rumah Sakit</span>
                        </label>

                        <label class="p-3 rounded-xl border {{ $status_pelayanan === 'rawat_inap' ? 'bg-blue-600/20 border-blue-500 text-white' : 'bg-slate-900 border-slate-700 text-slate-400' }} cursor-pointer flex items-center gap-2">
                            <input type="radio" wire:model.live="status_pelayanan" value="rawat_inap" class="text-blue-500">
                            <span class="text-xs font-bold">3. Observasi / Rawat Inap</span>
                        </label>
                    </div>

                    @if($status_pelayanan === 'rujuk')
                    <div class="bg-amber-500/10 border border-amber-500/30 rounded-2xl p-4 space-y-3">
                        <h4 class="text-xs font-bold text-amber-300 flex items-center gap-1.5">
                            <i data-lucide="send" class="w-4 h-4"></i> Data Surat Rujukan Faskes Lanjutan (FKRTL)
                        </h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div>
                                <label class="block text-slate-300 mb-1 font-semibold">Rumah Sakit Rujukan Tujuan *</label>
                                <select wire:model="rs_rujukan" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-xs text-white">
                                    <option value="RS Tk. IV 03.04.02 Salak Bogor (RST Salak)">RS Tk. IV 03.04.02 Salak Bogor (RST Salak)</option>
                                    <option value="RSUD Kota Bogor">RSUD Kota Bogor</option>
                                    <option value="RSUP Dr. Cipto Mangunkusumo (RSCM)">RSUP Dr. Cipto Mangunkusumo (RSCM)</option>
                                    <option value="RSPAD Gatot Soebroto">RSPAD Gatot Soebroto</option>
                                    <option value="RS PMI Kota Bogor">RS PMI Kota Bogor</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-slate-300 mb-1 font-semibold">Poli Spesialis yang Dituju *</label>
                                <input type="text" wire:model="poli_rujukan" placeholder="Contoh: Spesialis Jantung, Sp.PD, Bedah..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-xs text-white">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-slate-300 mb-1 font-semibold">Alasan Rujukan & Permintaan Tindakan Lanjutan *</label>
                                <input type="text" wire:model="alasan_rujukan" placeholder="Contoh: Evaluasi kardiomegali, pemeriksaan ekokardiografi & treadmill test..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-xs text-white">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-700/50">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold text-xs sm:text-sm transition flex items-center justify-center shadow-lg shadow-emerald-600/30">
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i> 
                        {{ $status_pelayanan === 'rujuk' ? 'Simpan Rekam Medis & Terbitkan Surat Rujukan' : 'Simpan Rekam Medis & Teruskan ke Apotek' }}
                    </button>
                </div>
            </form>
            @else
            <div class="text-center py-16 sm:py-24 text-slate-500">
                <div class="w-16 h-16 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-center mx-auto mb-3 text-slate-600">
                    <i data-lucide="stethoscope" class="w-8 h-8"></i>
                </div>
                <h4 class="text-sm font-bold text-slate-300">Belum Ada Pasien Dipilih</h4>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Pilih salah satu pasien di daftar antrian sebelah kiri untuk memulai pemeriksaan.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- MODAL CETAK SURAT RUJUKAN RESMI DOKTER -->
    @if($showRujukanModal && $lastRujukanData)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-md overflow-y-auto" x-cloak>
        <div class="relative w-full max-w-2xl bg-white text-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 my-auto printable-receipt">
            <!-- Header (Hidden when printed) -->
            <div class="bg-slate-900 text-white px-5 py-3.5 flex items-center justify-between no-print">
                <div class="flex items-center gap-2">
                    <i data-lucide="send" class="w-4 h-4 text-emerald-400"></i>
                    <span class="text-xs font-bold uppercase tracking-wider">Surat Rujukan Pasien Diterbitkan</span>
                </div>
                <button wire:click="closeRujukanModal" class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- DOCUMENT CONTENT -->
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
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 border border-emerald-300 px-2 py-1 rounded font-bold font-mono">{{ $lastRujukanData['no_rujukan'] }}</span>
                    </div>
                </div>

                <div class="text-center py-1">
                    <h3 class="text-sm font-black uppercase tracking-wider text-slate-900">SURAT RUJUKAN PASIEN RAWAT JALAN</h3>
                    <p class="text-[10px] text-slate-500">Standar Pelayanan Kesehatan Rujukan Berjenjang BPJS Kesehatan & SATUSEHAT</p>
                </div>

                <!-- RS Tujuan -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-[11px] text-slate-800 space-y-1">
                    <p>Kepada Yth. <strong>Dokter Spesialis {{ $lastRujukanData['poli_rujukan'] }}</strong></p>
                    <p>Fasilitas Pelayanan Kesehatan Rujukan Tingkat Lanjutan (FKRTL):</p>
                    <p class="text-base font-black text-emerald-900">{{ $lastRujukanData['rs_rujukan'] }}</p>
                </div>

                <!-- Data Pasien -->
                <div class="space-y-1.5 text-[11px] border border-slate-200 rounded-xl p-3">
                    <p class="font-bold text-slate-900 uppercase text-[10px]">Identitas Pasien yang Dirujuk:</p>
                    <div class="grid grid-cols-2 gap-2 text-slate-700">
                        <div>Nama: <strong class="text-slate-900">{{ $lastRujukanData['pasien']->nama_lengkap ?? '-' }}</strong></div>
                        <div>No. Rekam Medis: <strong class="font-mono">{{ $lastRujukanData['pasien']->no_rm ?? '-' }}</strong></div>
                        <div>No. Kartu BPJS / NIK: <strong class="font-mono">{{ $lastRujukanData['pasien']->nik ?? '-' }}</strong></div>
                        <div>Kategori Pasien: <strong>{{ $lastRujukanData['pasien']->kategori_pasien ?? '-' }}</strong></div>
                    </div>
                </div>

                <!-- Rincian Klinis -->
                <div class="space-y-2 text-[11px] bg-slate-50 border border-slate-200 rounded-xl p-3 text-slate-800">
                    <div>
                        <span class="text-slate-500 block text-[10px]">Diagnosa Rujukan (ICD-10):</span>
                        <strong class="text-sm text-emerald-900">{{ $lastRujukanData['diagnosa'] }} ({{ $lastRujukanData['icd10'] }})</strong>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[10px]">Alasan Rujukan / Permintaan Tindakan:</span>
                        <p class="text-slate-800 italic">{{ $lastRujukanData['alasan'] }}</p>
                    </div>
                </div>

                <!-- TTE Footer -->
                <div class="pt-3 flex justify-between items-end border-t border-slate-200 text-[11px]">
                    <div class="text-[9px] text-slate-500 space-y-1">
                        <p><strong>Masa Berlaku Rujukan:</strong> s/d {{ $lastRujukanData['berlaku'] }} (90 Hari)</p>
                        <p>Bawalah surat rujukan ini beserta KTP/KTA saat berobat ke RS Rujukan.</p>
                        <div class="font-mono text-[9px] tracking-[0.2em] text-slate-400">|||| ||| |||||| |||| | |||||</div>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] text-slate-600">Bogor, {{ $lastRujukanData['tgl_rujukan'] }}</p>
                        <p class="text-[10px] font-bold text-slate-800">Dokter Pengirim / Perujuk,</p>
                        <div class="my-2 font-mono text-[9px] text-emerald-800">[ TTE Tervalidasi SATUSEHAT ]</div>
                        <p class="font-bold text-slate-900">dr. Agus Susanto, Sp.PD</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-slate-100 p-4 border-t border-slate-200 flex flex-col sm:flex-row gap-2.5 no-print">
                <button type="button" onclick="window.print()" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-md transition">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak Surat Rujukan (Print / PDF)</span>
                </button>
                <button type="button" wire:click="closeRujukanModal" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs transition text-center">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
