<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrNonElektronik extends Model
{
    use HasFactory;

    protected $table = 'qr_non_elektroniks';

    protected $fillable = [
        'non_elektronik_id',
        'kode_qr',
        'url',
        'qr_path',
    ];

    /**
     * Relasi ke Non Elektronik
     * 1 QR dimiliki oleh 1 barang non elektronik
     */
    public function nonElektronik(): BelongsTo
    {
        return $this->belongsTo(NonElektronik::class);
    }
}
