<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QrBangunan extends Model
{
    use HasFactory;

    protected $table = 'qr_bangunans';

    protected $fillable = [
        'bangunan_id',
        'kode_qr',
        'url',
        'qr_path',
    ];

    /**
     * Setiap QR dimiliki oleh satu Bangunan
     */
    public function bangunan(): BelongsTo
    {
        return $this->belongsTo(Bangunan::class, 'bangunan_id');
    }

    /**
     * Ambil QR terbaru untuk satu bangunan
     */
    public function latest_qr(): HasOne
    {
        return $this->hasOne(QrBangunan::class)->latestOfMany();
    }
}
