<?php
use App\Http\Controllers\KendaraanDetailController;
use App\Http\Controllers\ElektronikDetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Elektronik;
use App\Models\QrKendaraan;
use App\Models\QrElektronik;
use App\Models\NonElektronik;
use App\Models\QrNonElektronik;
use App\Http\Controllers\NonElektronikDetailController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/fitur', function () {
    return view('fitur');
});

Route::get('/kendaraan/print/{kode}', function ($kode) {
    $qr = QrKendaraan::where('kode_qr', $kode)->firstOrFail();
    $record = $qr->kendaraan;
    return view('kendaraan.print-qr', compact('qr', 'record'));
})->name('kendaraan.print');

Route::get('/kendaraan/print-bulk', function (Request $request) {
    $codes = array_filter(explode(',', $request->query('codes', '')));
    if (empty($codes)) {
        abort(400, 'No QR codes provided');
    }

    // ambil kendaraan yang punya kode_qr tersebut
    $vehicles = Kendaraan::whereHas('qr_codes', function ($q) use ($codes) {
            $q->whereIn('kode_qr', $codes);
        })
        ->with(['qr_codes' => function ($q) use ($codes) {
            $q->whereIn('kode_qr', $codes)->latest();
        }])
        ->get();

    return view('kendaraan.print-bulk', compact('vehicles'));
})->name('kendaraan.print.bulk');

Route::get('/kendaraan/print-bulk-debug', function (Request $request) {
    return response()->json([
        'ok' => true,
        'fullUrl' => $request->fullUrl(),
        'codes' => $request->query('codes'),
        'autoprint' => $request->query('autoprint'),
    ]);
});

Route::get('/kendaraan/{kode_qr}', [KendaraanDetailController::class, 'show'])->name('kendaraan.show');

Route::get('/elektronik/print/{kode}', function ($kode) {
    $qr = QrElektronik::where('kode_qr', $kode)->firstOrFail();
    $record = $qr->elektronik;
    return view('elektronik.print-qr', compact('qr', 'record'));
})->name('elektronik.print');

Route::get('/elektronik/print-bulk', function (Request $request) {
    $codes = array_filter(explode(',', $request->query('codes', '')));
    if (empty($codes)) {
        abort(400, 'No QR codes provided');
    }


    $things = elektronik::whereHas('qrElektroniks', function ($q) use ($codes) {
            $q->whereIn('kode_qr', $codes);
        })
        ->with(['qrElektroniks' => function ($q) use ($codes) {
            $q->whereIn('kode_qr', $codes)->latest();
        }])
        ->get();

    return view('elektronik.print-bulk', compact('things'));
})->name('elektronik.print.bulk');

Route::get('/elektronik/print-bulk-debug', function (Request $request) {
    return response()->json([
        'ok' => true,
        'fullUrl' => $request->fullUrl(),
        'codes' => $request->query('codes'),
        'autoprint' => $request->query('autoprint'),
    ]);
});

Route::get('/elektronik/{kode_qr}', [ElektronikDetailController::class, 'show'])->name('elektronik.show');


Route::get('/non-elektronik/print/{kode}', function ($kode) {
    $qr = QrNonElektronik::where('kode_qr', $kode)->firstOrFail();
    $record = $qr->nonElektronik;

    return view('non-elektronik.print-qr', compact('qr', 'record'));
})->name('non-elektronik.print');


/* ================= BULK PRINT ================= */
Route::get('/non-elektronik/print-bulk', function (Request $request) {
    $codes = array_filter(explode(',', $request->query('codes', '')));

    if (empty($codes)) {
        abort(400, 'No QR codes provided');
    }

    $things = NonElektronik::whereHas('qrCode', function ($q) use ($codes) {
            $q->whereIn('kode_qr', $codes);
        })
        ->with(['qrCode' => function ($q) use ($codes) {
            $q->whereIn('kode_qr', $codes);
        }])
        ->get();

    return view('non-elektronik.print-bulk', compact('things'));
})->name('non-elektronik.print.bulk');


/* ================= DEBUG ================= */
Route::get('/non-elektronik/print-bulk-debug', function (Request $request) {
    return response()->json([
        'ok'        => true,
        'fullUrl'   => $request->fullUrl(),
        'codes'     => $request->query('codes'),
        'autoprint' => $request->query('autoprint'),
    ]);
});


/* ================= PUBLIC SCAN QR ================= */
Route::get('/non-elektronik/{kode_qr}', [NonElektronikDetailController::class, 'show'])
    ->name('non-elektronik.show');
