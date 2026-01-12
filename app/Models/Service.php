<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'kendaraan_id',
        'nopol',
        'tanggal_service',
        'deskripsi',
        'biaya',
    ];

    protected $casts = [
        'tanggal_service' => 'date',
        'biaya' => 'decimal:2',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
    
}
