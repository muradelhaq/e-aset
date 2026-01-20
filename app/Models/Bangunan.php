<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bangunan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel di database.
     * Kita definisikan manual karena standar Laravel biasanya jamak ('bangunans'),
     * sedangkan SQL Anda tunggal ('bangunan').
     */
    protected $table = 'bangunan';

    /**
     * Mengizinkan mass assignment untuk semua kolom.
     */
    protected $guarded = [];

    /**
     * Konversi tipe data otomatis.
     */
    protected $casts = [
        'tanggal' => 'date',
        'luas_lantai' => 'decimal:2',
        'luas' => 'decimal:2',
        'harga' => 'decimal:2',
    ];
    public function qr_codes()
    {
        return $this->hasMany(QrBangunan::class);
    }
    public function qrBangunans()
    {
        return $this->hasMany(QrBangunan::class, 'bangunan_id');
    }


}
