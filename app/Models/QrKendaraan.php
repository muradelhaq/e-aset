<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrKendaraan extends Model
{
    use HasFactory;

    // Mass assignment protection
    protected $fillable = [
        'kendaraan_id',
        'kode_qr',
        'url',
        'qr_path',
    ];

    /**
     * Relasi ke model Kendaraan (Many to One)
     * Setiap QR Code dimiliki oleh satu kendaraan tertentu.
     */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
