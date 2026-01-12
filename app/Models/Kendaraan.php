<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel di database.
     */
    protected $table = 'kendaraans';

    /**
     * Mengizinkan semua kolom untuk diisi secara massal oleh Filament.
     * (Aman selama kita menggunakan validasi di Form).
     */
    protected $guarded = [];

    /**
     * Casting (Konversi Tipe Data Otomatis).
     * Penting agar Filament mengenali Tanggal sebagai objek (bukan teks)
     * dan Harga sebagai angka desimal.
     */
    protected $casts = [
        'tgl_pajak' => 'date',
        'tgl_perolehan' => 'date',
        'harga' => 'decimal:2',
    ];
    public function services()
    {
    return $this->hasMany(Service::class);
    }
    public function qr_codes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QrKendaraan::class);
    }

    /**
     * Opsional: Mengambil QR Code terbaru saja
     */
    public function latest_qr()
    {
        return $this->hasOne(QrKendaraan::class)->latestOfMany();
    }


}

