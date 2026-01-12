<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\QrKendaraan;
use Illuminate\Http\Request;

class KendaraanDetailController extends Controller
{
    public function show($kode_qr)
    {
        // Cari QR di tabel qr_kendaraans
        $qr = QrKendaraan::where('kode_qr', $kode_qr)
            ->with('kendaraan')
            ->firstOrFail();

        // Ambil data kendaraan dari relasi
        $kendaraan = $qr->kendaraan;

        return view('kendaraan-detail', compact('kendaraan', 'qr'));
    }
}
