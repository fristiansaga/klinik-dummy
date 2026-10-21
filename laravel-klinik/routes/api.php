<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Obat;
use App\Models\Poli;
use App\Models\Dokter;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes (REST Endpoints for Mobile / External Services)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    
    // 1. Data Poli & Dokter
    Route::get('/polis', function () {
        return response()->json(['status' => 'success', 'data' => Poli::where('status_aktif', true)->get()]);
    });

    Route::get('/dokters', function () {
        return response()->json(['status' => 'success', 'data' => Dokter::with('poli')->where('status_aktif', true)->get()]);
    });

    // 2. Data Pasien (CRUD)
    Route::get('/pasiens', function (Request $request) {
        $q = $request->query('search');
        $pasiens = Pasien::when($q, function ($query) use ($q) {
            $query->where('nama_lengkap', 'like', "%{$q}%")
                  ->orWhere('no_rm', 'like', "%{$q}%")
                  ->orWhere('nik', 'like', "%{$q}%");
        })->latest()->paginate(15);

        return response()->json(['status' => 'success', 'data' => $pasiens]);
    });

    // 3. Status Antrian Real-Time
    Route::get('/antrian/today', function () {
        $today = Carbon::today();
        $antrians = Antrian::with(['pasien', 'poli', 'dokter'])
            ->whereDate('waktu_daftar', $today)
            ->get();

        return response()->json(['status' => 'success', 'data' => $antrians]);
    });

    // 4. Katalog Obat
    Route::get('/obats', function () {
        return response()->json(['status' => 'success', 'data' => Obat::all()]);
    });
});
