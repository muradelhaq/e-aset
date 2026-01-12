<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanahs', function (Blueprint $table) {
            $table->id();

            $table->string('kode_lokasi')->nullable();
            $table->string('jenis_barang')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('register')->nullable();

            $table->decimal('luas', 15, 2)->nullable(); // m²
            $table->string('alamat')->nullable();

            $table->string('status_tanah')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('nomor_sertifikat')->nullable();

            $table->string('penggunaan')->nullable();
            $table->string('asal_usul')->nullable();

            $table->decimal('harga', 20, 2)->nullable();
            $table->date('tanggal_perolehan')->nullable();

            $table->string('pemilik')->nullable();

            $table->text('keterangan')->nullable();

            $table->string('foto')->nullable();

            $table->string('no_sk')->nullable();
            $table->string('upload_SK')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanahs');
    }
};
