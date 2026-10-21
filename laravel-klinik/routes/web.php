<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\DashboardKlinik;
use App\Livewire\PortalPasien;
use App\Livewire\PendaftaranPasien;
use App\Livewire\DisplayAntrian;
use App\Livewire\PemeriksaanDokter;
use App\Livewire\ApotekFarmasi;
use App\Livewire\KasirPembayaran;

/*
|--------------------------------------------------------------------------
| Web Routes - Livewire v3 Clinical Management System
|--------------------------------------------------------------------------
*/

Route::get('/', DashboardKlinik::class)->name('dashboard');
Route::get('/pasien', PortalPasien::class)->name('pasien');
Route::get('/pendaftaran', PendaftaranPasien::class)->name('pendaftaran');
Route::get('/antrian', DisplayAntrian::class)->name('antrian');
Route::get('/pemeriksaan', PemeriksaanDokter::class)->name('pemeriksaan');
Route::get('/farmasi', ApotekFarmasi::class)->name('farmasi');
Route::get('/kasir', KasirPembayaran::class)->name('kasir');
