<div class="space-y-6">
    <!-- Header Title & Tab Switcher -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight flex items-center gap-2">
                <i data-lucide="receipt" class="w-6 h-6 text-emerald-400"></i>
                Kasir & Pembayaran Pasien
            </h1>
            <p class="text-slate-400 text-xs sm:text-sm mt-0.5">Billing otomatis biaya tindakan, konsultasi dokter, obat & cetak struk kwitansi resmi</p>
        </div>

        <div class="flex items-center space-x-2 bg-slate-950/80 p-1 rounded-xl border border-slate-800 self-start sm:self-auto">
            <button wire:click="setTab('pending')" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $activeTab === 'pending' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                <span>Menunggu ({{ count($tagihanPending) }})</span>
            </button>
            <button wire:click="setTab('history')" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-1.5 {{ $activeTab === 'history' ? 'bg-emerald-600 text-white shadow-md' : 'text-slate-400 hover:text-white' }}">
                <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                <span>Riwayat & Struk</span>
            </button>
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

    <!-- TAB 1: PENDING BILLINGS & CHECKOUT -->
    @if ($activeTab === 'pending')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Tagihan Menunggu Pembayaran -->
        <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm sm:text-base font-bold text-white flex items-center">
                        <i data-lucide="receipt" class="w-4 h-4 mr-2 text-emerald-400"></i> Tagihan Belum Dibayar
                    </h3>
                    <span class="text-xs bg-amber-500/10 text-amber-400 border border-amber-500/20 px-2 py-0.5 rounded-full font-semibold">
                        {{ count($tagihanPending) }} Pasien
                    </span>
                </div>

                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-1">
                    @forelse($tagihanPending as $item)
                    <div wire:click="selectTransaksi({{ $item->id }})" class="p-4 rounded-xl {{ $selectedTransaksiId == $item->id ? 'bg-emerald-600/20 border-emerald-500 shadow-lg shadow-emerald-600/20' : 'bg-slate-900/60 border-slate-800' }} border hover:border-emerald-500/50 cursor-pointer transition flex items-center justify-between">
                        <div class="min-w-0 flex-1 mr-2">
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] font-mono font-bold text-emerald-400">{{ $item->no_kwitansi }}</span>
                                <span class="text-[10px] px-1.5 py-0.5 rounded bg-slate-800 text-slate-300 font-medium truncate max-w-[120px]">{{ $item->pasien->kategori_pasien }}</span>
                            </div>
                            <h4 class="font-bold text-white text-sm mt-1 truncate">{{ $item->pasien->nama_lengkap }}</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">RM: {{ $item->pasien->no_rm }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-black text-amber-400 block">
                                Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}
                            </span>
                            <span class="text-[10px] text-emerald-400 font-medium hover:underline">Bayar →</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 text-slate-500">
                        <i data-lucide="check-circle-2" class="w-10 h-10 mx-auto mb-2 text-emerald-500/40"></i>
                        <p class="text-xs font-semibold text-slate-400">Semua tagihan sudah diselesaikan.</p>
                        <p class="text-[11px] text-slate-500 mt-1">Tidak ada pasien dalam antrian kasir.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Form Proses Pembayaran / Invoice Details -->
        <div class="lg:col-span-2 p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl">
            @if ($currentTransaksi)
            <form wire:submit.prevent="prosesBayar" class="space-y-5">
                <div class="border-b border-slate-700/60 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <span class="text-xs text-emerald-400 font-bold font-mono">INVOICE {{ $currentTransaksi->no_kwitansi }}</span>
                        <h3 class="text-lg font-bold text-white mt-0.5">{{ $currentTransaksi->pasien->nama_lengkap }}</h3>
                        <p class="text-xs text-slate-400">{{ $currentTransaksi->pasien->kategori_pasien }} • No. RM: {{ $currentTransaksi->pasien->no_rm }} • NIK/NRP: {{ $currentTransaksi->pasien->nik }}</p>
                    </div>
                    <span class="self-start sm:self-auto px-3 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 rounded-full text-xs font-bold">
                        Status: Belum Lunas
                    </span>
                </div>

                <!-- Rincian Biaya -->
                <div class="space-y-2.5 bg-slate-900/70 p-4 rounded-xl border border-slate-800 text-xs sm:text-sm">
                    <div class="flex justify-between text-slate-300">
                        <span>Biaya Konsultasi Dokter:</span>
                        <span class="font-semibold text-white">Rp {{ number_format($currentTransaksi->biaya_konsultasi, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-300">
                        <span>Biaya Tindakan Medis:</span>
                        <span class="font-semibold text-white">Rp {{ number_format($currentTransaksi->biaya_tindakan, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-300">
                        <span>Biaya Resep Obat & Farmasi:</span>
                        <span class="font-semibold text-white">Rp {{ number_format($currentTransaksi->biaya_obat, 0, ',', '.') }}</span>
                    </div>

                    @if($currentTransaksi->rekamMedis && $currentTransaksi->rekamMedis->resepDetails && count($currentTransaksi->rekamMedis->resepDetails) > 0)
                    <div class="pl-3 border-l-2 border-slate-700 space-y-1 py-1">
                        @foreach($currentTransaksi->rekamMedis->resepDetails as $itemResep)
                        <div class="flex justify-between text-[11px] text-slate-400">
                            <span>• {{ $itemResep->nama_obat }} ({{ $itemResep->jumlah }} unit)</span>
                            <span>Rp {{ number_format($itemResep->total_harga, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="border-t border-slate-700 pt-2.5 flex justify-between text-base font-extrabold text-emerald-400">
                        <span>TOTAL TAGIHAN:</span>
                        <span>Rp {{ number_format($currentTransaksi->total_tagihan, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Payment Form Controls -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Metode Pembayaran</label>
                        <select wire:model="metodePembayaran" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                            <option value="Tunai">Tunai (Cash)</option>
                            <option value="QRIS">QRIS / E-Wallet (BCA/Gojek/ShopeePay)</option>
                            <option value="Transfer Bank">Transfer Bank Mandiri/BRI/BNI</option>
                            <option value="Ditanggung Dinas / BPJS">Ditanggung Dinas TNI AD / BPJS (Gratis)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1.5">Nominal Diterima (Rp)</label>
                        <input type="number" wire:model.live="jumlahBayar" placeholder="Masukkan jumlah uang dibayar..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm text-white focus:outline-none focus:border-emerald-500">
                    </div>
                </div>

                <!-- Kembalian Box -->
                @if($jumlahBayar >= $currentTransaksi->total_tagihan && $currentTransaksi->total_tagihan > 0)
                <div class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex justify-between items-center">
                    <span class="text-xs text-emerald-300 font-semibold">Kembalian untuk Pasien:</span>
                    <span class="text-base sm:text-lg font-black text-emerald-400">Rp {{ number_format(max(0, $jumlahBayar - $currentTransaksi->total_tagihan), 0, ',', '.') }}</span>
                </div>
                @endif

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-700/50">
                    <button type="button" wire:click="$set('currentTransaksi', null)" class="px-4 py-2.5 rounded-xl bg-slate-800 text-slate-300 hover:bg-slate-700 text-xs font-semibold transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold text-xs sm:text-sm transition flex items-center justify-center shadow-lg shadow-emerald-600/30">
                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Konfirmasi Bayar & Buka Struk
                    </button>
                </div>
            </form>
            @else
            <div class="text-center py-16 sm:py-24 text-slate-500">
                <div class="w-16 h-16 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-center mx-auto mb-3 text-slate-600">
                    <i data-lucide="receipt" class="w-8 h-8"></i>
                </div>
                <h4 class="text-sm font-bold text-slate-300">Belum Ada Tagihan Dipilih</h4>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1">Pilih salah satu tagihan pasien pada daftar sebelah kiri untuk memproses pembayaran dan menerbitkan struk kwitansi.</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- TAB 2: RIWAYAT TRANSAKSI & CETAK ULANG STRUK -->
    @if ($activeTab === 'history')
    <div class="p-5 sm:p-6 rounded-2xl bg-slate-800/40 border border-slate-700/50 backdrop-blur-xl space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-white flex items-center">
                    <i data-lucide="history" class="w-4 h-4 mr-2 text-emerald-400"></i> Riwayat Pembayaran Selesai & Cetak Ulang
                </h3>
                <p class="text-xs text-slate-400 mt-0.5">Daftar transaksi yang telah lunas dan siap dicetak ulang struk kwitansinya</p>
            </div>

            <div class="w-full sm:w-72">
                <input type="text" wire:model.live.debounce.300ms="searchHistory" placeholder="Cari No. Kwitansi / Nama / RM..." class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3.5 py-2 text-xs text-white focus:outline-none focus:border-emerald-500">
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-800">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="text-[11px] text-slate-400 uppercase bg-slate-900/90 border-b border-slate-700">
                    <tr>
                        <th class="px-4 py-3">No. Kwitansi</th>
                        <th class="px-4 py-3">Nama Pasien</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Waktu Bayar</th>
                        <th class="px-4 py-3">Metode</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3 text-right">Aksi Struk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($transaksiSelesai as $trx)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-4 py-3 font-mono font-bold text-emerald-400">{{ $trx->no_kwitansi }}</td>
                        <td class="px-4 py-3">
                            <span class="font-bold text-white">{{ $trx->pasien->nama_lengkap ?? '-' }}</span>
                            <span class="block text-[10px] text-slate-400">RM: {{ $trx->pasien->no_rm ?? '-' }}</span>
                        </td>
                        <td class="px-4 py-3 text-slate-300">{{ $trx->pasien->kategori_pasien ?? '-' }}</td>
                        <td class="px-4 py-3 text-slate-400">{{ $trx->updated_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-800 text-emerald-300 border border-slate-700">
                                {{ $trx->metode_pembayaran }}
                            </span>
                        </td>
                        <td class="px-4 py-3 font-bold text-white">Rp {{ number_format($trx->total_tagihan, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-right">
                            <button wire:click="cetakStruk({{ $trx->id }})" class="px-3 py-1.5 bg-emerald-600/20 hover:bg-emerald-600 text-emerald-300 hover:text-white border border-emerald-500/30 rounded-lg text-xs font-semibold transition inline-flex items-center gap-1 shadow-sm">
                                <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                                <span>Cetak Struk</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-slate-500">
                            Belum ada riwayat transaksi lunas yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- MODAL STRUK PEMBAYARAN / KWITANSI RESMI (THERMAL & DIGITAL PRINT) -->
    @if ($showStrukModal && $strukData)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/80 backdrop-blur-md overflow-y-auto" x-cloak>
        <div class="relative w-full max-w-md bg-white text-slate-900 rounded-3xl shadow-2xl overflow-hidden border border-slate-200 my-auto printable-receipt">
            
            <!-- Top Action Header (Hidden when printed) -->
            <div class="bg-slate-900 text-white px-5 py-3.5 flex items-center justify-between no-print">
                <div class="flex items-center gap-2">
                    <i data-lucide="printer" class="w-4 h-4 text-emerald-400"></i>
                    <span class="text-xs font-bold uppercase tracking-wider">Preview Struk Kwitansi Resmi</span>
                </div>
                <button wire:click="closeStruk" class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <!-- THERMAL RECEIPT SLIP CONTENT -->
            <div class="p-6 font-sans text-xs space-y-4" id="thermal-receipt-content">
                <!-- Clinic Header / KOP -->
                <div class="text-center space-y-1 border-b border-dashed border-slate-300 pb-3">
                    <div class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-emerald-800 text-white mb-1 shadow-sm">
                        <i data-lucide="cross" class="w-5 h-5"></i>
                    </div>
                    <h2 class="text-sm font-black tracking-wider text-slate-900 uppercase">KLINIK PRATAMA PUSDIKZI</h2>
                    <p class="text-[10px] text-slate-600 font-medium">PUSAT PENDIDIKAN ZENI TNI ANGKATAN DARAT</p>
                    <p class="text-[9px] text-slate-500">Jl. Jenderal Sudirman No. 35, Kota Bogor | Telp: (0251) 832-1234</p>
                    <div class="pt-1">
                        <span class="inline-block bg-slate-100 text-slate-800 font-mono font-bold text-[10px] px-2 py-0.5 rounded border border-slate-200">
                            KWITANSI PEMBAYARAN PASIEN
                        </span>
                    </div>
                </div>

                <!-- Metadata Transaksi -->
                <div class="space-y-1 text-[11px] text-slate-700">
                    <div class="flex justify-between">
                        <span class="text-slate-500">No. Kwitansi:</span>
                        <strong class="font-mono text-slate-900">{{ $strukData->no_kwitansi }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Tanggal/Jam:</span>
                        <span>{{ $strukData->updated_at->format('d/m/Y H:i') }} WIB</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Kasir:</span>
                        <span>Petugas Medis PUSDIKZI</span>
                    </div>
                    <div class="border-t border-slate-200 pt-1 mt-1"></div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">No. Rekam Medis:</span>
                        <strong class="font-mono text-slate-900">{{ $strukData->pasien->no_rm ?? '-' }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Nama Pasien:</span>
                        <strong class="text-slate-900">{{ $strukData->pasien->nama_lengkap ?? '-' }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Kategori Pasien:</span>
                        <span class="font-semibold text-emerald-800">{{ $strukData->pasien->kategori_pasien ?? '-' }}</span>
                    </div>
                    @if($strukData->rekamMedis && $strukData->rekamMedis->dokter)
                    <div class="flex justify-between">
                        <span class="text-slate-500">Dokter:</span>
                        <span>{{ $strukData->rekamMedis->dokter->nama_lengkap }}</span>
                    </div>
                    @endif
                </div>

                <!-- Rincian Biaya Itemized -->
                <div class="border-t border-b border-dashed border-slate-300 py-2.5 space-y-1.5 text-[11px]">
                    <div class="flex justify-between text-slate-700">
                        <span>1. Jasa Konsultasi Dokter</span>
                        <span class="font-mono font-semibold">Rp {{ number_format($strukData->biaya_konsultasi, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-700">
                        <span>2. Tindakan Medis</span>
                        <span class="font-mono font-semibold">Rp {{ number_format($strukData->biaya_tindakan, 0, ',', '.') }}</span>
                    </div>

                    @if($strukData->rekamMedis && $strukData->rekamMedis->resepDetails && count($strukData->rekamMedis->resepDetails) > 0)
                    <div class="space-y-1 pt-1">
                        <span class="text-[10px] text-slate-500 block font-semibold">3. Rincian Obat Farmasi:</span>
                        @foreach($strukData->rekamMedis->resepDetails as $obatItem)
                        <div class="flex justify-between pl-2 text-[10px] text-slate-600">
                            <span>• {{ $obatItem->nama_obat }} ({{ $obatItem->jumlah }}x)</span>
                            <span class="font-mono">Rp {{ number_format($obatItem->total_harga, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="flex justify-between text-slate-700">
                        <span>3. Biaya Obat Farmasi</span>
                        <span class="font-mono font-semibold">Rp {{ number_format($strukData->biaya_obat, 0, ',', '.') }}</span>
                    </div>
                    @endif
                </div>

                <!-- Totals & Payment Summary -->
                <div class="space-y-1.5 text-xs text-slate-800">
                    <div class="flex justify-between font-black text-sm text-slate-900 pt-1">
                        <span>TOTAL TAGIHAN:</span>
                        <span class="font-mono text-emerald-800">Rp {{ number_format($strukData->total_tagihan, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-[11px] text-slate-600">
                        <span>Metode Pembayaran:</span>
                        <strong class="text-slate-800">{{ $strukData->metode_pembayaran }}</strong>
                    </div>
                    <div class="flex justify-between text-[11px] text-slate-600">
                        <span>Jumlah Dibayar:</span>
                        <span class="font-mono font-semibold text-slate-900">Rp {{ number_format($strukData->jumlah_bayar, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-[11px] text-slate-600">
                        <span>Kembalian:</span>
                        <span class="font-mono font-semibold text-slate-900">Rp {{ number_format($strukData->kembalian, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Stamp Lunas & Barcode -->
                <div class="border-t border-slate-200 pt-3 text-center space-y-2">
                    <div class="inline-block border-2 border-emerald-600 text-emerald-700 font-black text-xs px-3 py-1 rounded-md transform -rotate-2 uppercase tracking-widest">
                        ✓ L U N A S
                    </div>

                    <!-- Barcode Representation -->
                    <div class="flex flex-col items-center justify-center space-y-1 pt-1">
                        <div class="font-mono text-[9px] tracking-[0.25em] text-slate-400">||||| | |||| ||| |||||| |||| | |||||</div>
                        <span class="text-[9px] font-mono text-slate-400">{{ $strukData->no_kwitansi }}</span>
                    </div>

                    <p class="text-[9px] text-slate-500 italic">
                        *Terima kasih telah mempercayakan kesehatan Anda pada Klinik Pratama PUSDIKZI TNI AD. Semoga lekas sembuh.*
                    </p>
                </div>
            </div>

            <!-- Footer Action Buttons (Hidden on print) -->
            <div class="bg-slate-100 p-4 border-t border-slate-200 flex flex-col sm:flex-row gap-2.5 no-print">
                <button type="button" onclick="window.print()" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-md transition">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak Struk (Print)</span>
                </button>
                <button type="button" wire:click="closeStruk" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs transition text-center">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
