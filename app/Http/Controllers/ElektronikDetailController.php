<?php

namespace App\Http\Controllers;

use App\Models\Elektronik;
use App\Models\QrElektronik;
use Illuminate\Http\Request;

class ElektronikDetailController extends Controller
{
    public function show($kode_qr)
    {
        // Cari QR elektronik
        $qr = QrElektronik::where('kode_qr', $kode_qr)
            ->with('elektronik')
            ->firstOrFail();

        // Ambil data elektronik dari relasi
        $elektronik = $qr->elektronik;

        return view('elektronik-detail', compact('elektronik', 'qr'));
    }
}
