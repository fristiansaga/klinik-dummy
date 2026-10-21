<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2">
                <i data-lucide="pill" class="w-6 h-6 text-emerald-400"></i>
                Apotek & Manajemen Farmasi
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Dispensing obat, antrian resep dokter, monitoring zat aktif generik & merek paten</p>
        </div>

        <button wire:click="openAddModal" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-emerald-600/30 self-start sm:self-auto">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Master Obat
        </button>
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Antrian e-Resep Masuk -->
        <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm sm:text-base font-bold text-white flex items-center">
                    <i data-lucide="clipboard-list" class="w-4 h-4 mr-2 text-emerald-400"></i> Antrian Resep Masuk Dokter
                </h3>
                <span class="text-xs bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-0.5 rounded-full font-semibold">
                    {{ count($antrianResep) }} Antrean
                </span>
            </div>

            <div class="space-y-3 max-h-[520px] overflow-y-auto pr-1">
                @forelse($antrianResep as $resep)
                <div class="p-4 rounded-xl bg-slate-900/70 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="text-xs font-bold text-emerald-400">{{ $resep->rekamMedis->pasien->nama_lengkap ?? 'Pasien' }}</span>
                        <h4 class="text-sm font-bold text-white mt-0.5">{{ $resep->nama_obat }} ({{ $resep->jumlah }} unit)</h4>
                        <p class="text-xs text-slate-400">Aturan: <strong class="text-slate-300">{{ $resep->aturan_pakai }}</strong></p>
                    </div>
                    <button wire:click="prosesTebus({{ $resep->id }})" class="self-start sm:self-auto px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold transition flex items-center shadow-lg shadow-emerald-600/30">
                        <i data-lucide="check" class="w-3.5 h-3.5 mr-1"></i> Siapkan & Tebus
                    </button>
                </div>
                @empty
                <div class="text-center py-12 text-slate-500">
                    <i data-lucide="check-circle" class="w-10 h-10 mx-auto mb-2 text-slate-600"></i>
                    <p class="text-xs">Tidak ada antrian resep pending.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Monitoring Katalog & Stok Obat -->
        <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4">
                <h3 class="text-sm sm:text-base font-bold text-white flex items-center">
                    <i data-lucide="box" class="w-4 h-4 mr-2 text-emerald-400"></i> Master & Stok Obat ({{ count($katalogObat) }})
                </h3>
                
                <div class="flex items-center gap-2">
                    <select wire:model.live="golonganFilter" class="bg-slate-900 border border-slate-700 rounded-lg px-2.5 py-1.5 text-xs text-white focus:outline-none focus:border-emerald-500">
                        <option value="semua">Semua Golongan</option>
                        <option value="Generik">Generik (BPJS/Dinas)</option>
                        <option value="Paten / Bermerek">Paten / Bermerek</option>
                        <option value="BHP / Alkes">BHP / Alkes</option>
                    </select>

                    <input type="text" wire:model.live.debounce.300ms="searchObat" placeholder="Cari generik/merek..." class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <div class="overflow-x-auto max-h-[520px] overflow-y-auto rounded-xl border border-slate-800">
                <table class="w-full text-left text-xs text-slate-300">
                    <thead class="text-[11px] text-slate-400 uppercase bg-slate-900 border-b border-slate-700 sticky top-0">
                        <tr>
                            <th class="px-3 py-2.5">Zat Aktif / Generik</th>
                            <th class="px-3 py-2.5">Merek & Pabrik</th>
                            <th class="px-3 py-2.5">Stok</th>
                            <th class="px-3 py-2.5">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($katalogObat as $obat)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="px-3 py-2.5 font-medium text-white">
                                <div class="font-bold">{{ $obat->nama_obat }}</div>
                                <div class="text-[10px] text-slate-400 font-mono">{{ $obat->kode_obat }} • {{ $obat->kategori }}</div>
                            </td>
                            <td class="px-3 py-2.5">
                                <div class="flex items-center gap-1.5">
                                    <strong class="text-emerald-300">{{ $obat->merek ?: '-' }}</strong>
                                    <span class="text-[9px] px-1.5 py-0.2 rounded font-semibold {{ $obat->golongan_obat === 'Generik' ? 'bg-blue-500/20 text-blue-300' : 'bg-amber-500/20 text-amber-300' }}">
                                        {{ $obat->golongan_obat ?: 'Generik' }}
                                    </span>
                                </div>
                                <div class="text-[10px] text-slate-400">{{ $obat->produsen ?: 'Pabrik Farmasi' }}</div>
                            </td>
                            <td class="px-3 py-2.5">
                                <span class="font-mono font-bold {{ $obat->stok <= $obat->min_stok ? 'text-rose-400 bg-rose-500/10 px-1.5 py-0.5 rounded' : 'text-emerald-400' }}">
                                    {{ $obat->stok }} {{ $obat->satuan }}
                                </span>
                            </td>
                            <td class="px-3 py-2.5 font-mono text-white font-semibold">
                                Rp {{ number_format($obat->harga_jual) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-slate-500">Tidak ada obat ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH MASTER OBAT BARU -->
    @if($showAddModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md overflow-y-auto" x-cloak>
        <div class="relative w-full max-w-lg bg-slate-900 text-white rounded-2xl shadow-2xl overflow-hidden border border-slate-700">
            <div class="bg-slate-800 px-5 py-3.5 flex items-center justify-between border-b border-slate-700">
                <div class="flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-4 h-4 text-emerald-400"></i>
                    <span class="text-xs font-bold uppercase tracking-wider">Tambah Master Data Obat & Farmasi</span>
                </div>
                <button wire:click="closeAddModal" class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-slate-700 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form wire:submit.prevent="simpanObatBaru" class="p-5 sm:p-6 space-y-4 text-xs">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Kode Obat *</label>
                        <input type="text" wire:model="new_kode_obat" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white font-mono">
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Golongan Obat *</label>
                        <select wire:model="new_golongan_obat" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                            <option value="Generik">Generik (Standar FORNAS / BPJS)</option>
                            <option value="Paten / Bermerek">Paten / Bermerek Dagang</option>
                            <option value="BHP / Alkes">Bahan Medis Habis Pakai (BMHP)</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-slate-300 mb-1 font-semibold">Nama Generik (Zat Aktif & Dosis) *</label>
                        <input type="text" wire:model="new_nama_obat" placeholder="Contoh: Paracetamol 500 mg, Amlodipine 10 mg..." class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                        <span class="text-[10px] text-slate-400">Wajib diisi sesuai nama zat aktif untuk integrasi SATUSEHAT & e-resep.</span>
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Merek Dagang (Brand Name)</label>
                        <input type="text" wire:model="new_merek" placeholder="Contoh: Sanmol, Panadol, Norvask (Opsional)" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Pabrik / Produsen Farmasi</label>
                        <input type="text" wire:model="new_produsen" placeholder="Contoh: Kimia Farma, Sanbe, Kalbe..." class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Bentuk Sediaan</label>
                        <select wire:model="new_kategori" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Sirup">Sirup / Suspensi</option>
                            <option value="Injeksi">Injeksi / Ampul</option>
                            <option value="Salep">Salep / Krim</option>
                            <option value="Tetes">Tetes Mata / Telinga</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Satuan Kemasan</label>
                        <select wire:model="new_satuan" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                            <option value="Strip">Strip (10 Tab)</option>
                            <option value="Tablet">Tablet / Butir</option>
                            <option value="Botol">Botol (Flacon)</option>
                            <option value="Tube">Tube</option>
                            <option value="Ampul">Ampul</option>
                            <option value="Pcs">Pcs</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Stok Awal Fisik</label>
                        <input type="number" wire:model="new_stok" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white">
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1 font-semibold">Harga Jual per Satuan (Rp)</label>
                        <input type="number" wire:model="new_harga_jual" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 text-white font-mono">
                    </div>
                </div>

                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-800">
                    <button type="button" wire:click="closeAddModal" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 rounded-xl text-slate-300 font-semibold transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold transition flex items-center gap-1.5 shadow-lg shadow-emerald-600/30">
                        <i data-lucide="check" class="w-4 h-4"></i> Simpan Obat
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
