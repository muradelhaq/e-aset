<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QrElektronik extends Model
{
    use HasFactory;

    protected $table = 'qr_elektroniks';

    protected $fillable = [
        'elektronik_id',
        'kode_qr',
        'url',
        'qr_path',
    ];

    /**
     * Setiap QR dimiliki oleh satu Elektronik
     */
    public function elektronik(): BelongsTo
    {
        return $this->belongsTo(Elektronik::class, 'elektronik_id');
    }

        public function latest_qr()
    {
        return $this->hasOne(QrElektronik::class)->latestOfMany();
    }
}
