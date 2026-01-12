<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceElektronik extends Model
{
    protected $table = 'service_elektroniks';

    protected $fillable = [
        'elektronik_id',
        'tanggal_service',
        'deskripsi',
        'biaya',
    ];

    protected $casts = [
        'tanggal_service' => 'date',
        'biaya' => 'decimal:2',
    ];

    public function elektronik(): BelongsTo
    {
        return $this->belongsTo(Elektronik::class);
    }
}
