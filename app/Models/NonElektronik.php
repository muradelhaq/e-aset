<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class NonElektronik extends Model
{
    use SoftDeletes;

    protected $table = 'non_elektroniks';

    protected $fillable = [
        'jenis_barang',
        'nama_barang',
        'bahan',
        'warna',
        'ukuran',
        'jumlah',
        'merk',
        'tgl_perolehan',
        'harga',
        'kondisi',
        'pemilik',
        'keterangan',
        'foto',
        'no_sk',
        'upload_sk',
    ];

    protected $casts = [
        'tgl_perolehan' => 'date',
        'harga' => 'decimal:2',
    ];
    public function qrCode(): HasOne
{
    return $this->hasOne(QrNonElektronik::class);
}

}

