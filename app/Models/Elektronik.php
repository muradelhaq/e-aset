<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Elektronik extends Model
{
    use SoftDeletes;

    protected $table = 'elektronik';

    protected $fillable = [
        'jenis_barang',
        'merk',
        'tipe',
        'warna',
        'spek',
        'no_seri',
        'tgl_perolehan',
        'harga',
        'kondisi',
        'pemilik',
        'keterangan',
        'foto',
        'no_sk',
        'upload_SK',
    ];

    protected $casts = [
        'tgl_perolehan' => 'date',
        'harga' => 'decimal:2',
    ];
    public function serviceElektroniks(): HasMany
        {
            return $this->hasMany(ServiceElektronik::class, 'elektronik_id');
        }
    public function qrElektroniks(): HasMany
{
    return $this->hasMany(QrElektronik::class, 'elektronik_id');
}

}
