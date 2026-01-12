<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tanah extends Model
{
    use SoftDeletes;

    protected $table = 'tanahs'; // ganti ke 'tanah' jika tabel singular

    protected $fillable = [
        'kode_lokasi',
        'jenis_barang',
        'kode_barang',
        'register',
        'luas',
        'alamat',
        'status_tanah',
        'sertifikat',
        'nomor_sertifikat',
        'penggunaan',
        'asal_usul',
        'harga',
        'tanggal_perolehan',
        'pemilik',
        'keterangan',
        'foto',
        'no_sk',
        'upload_SK',
    ];

    protected $casts = [
        'luas' => 'decimal:2',
        'harga' => 'decimal:2',
        'tanggal_perolehan' => 'date',
    ];
}
