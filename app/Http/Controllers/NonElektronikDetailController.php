<?php

namespace App\Http\Controllers;

use App\Models\NonElektronik;
use App\Models\QrNonElektronik;
use Illuminate\Http\Request;

class NonElektronikDetailController extends Controller
{
    public function show($kode_qr)
    {
        // Cari QR non elektronik
        $qr = QrNonElektronik::where('kode_qr', $kode_qr)
            ->with('nonElektronik')
            ->firstOrFail();

        // Ambil data non elektronik dari relasi
        $nonElektronik = $qr->nonElektronik;

        return view('non-elektronik-detail', compact('nonElektronik', 'qr'));
    }
}
