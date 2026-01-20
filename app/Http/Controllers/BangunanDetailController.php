<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use App\Models\QrBangunan;
use Illuminate\Http\Request;

class BangunanDetailController extends Controller
{
    public function show($kode_qr)
    {
        // Cari QR Bangunan berdasarkan kode QR
        $qr = QrBangunan::where('kode_qr', $kode_qr)
            ->with('bangunan')
            ->firstOrFail();

        // Ambil data bangunan dari relasi
        $bangunan = $qr->bangunan;

        return view('bangunan-detail', compact('bangunan', 'qr'));
    }
}
