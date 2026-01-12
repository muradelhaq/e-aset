<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Nama tabel diset 'bangunan' sesuai request SQL Anda (bukan jamak/plural)
        Schema::create('bangunan', function (Blueprint $table) {
            $table->id();

            // Identitas Barang
            $table->string('kode_lokasi')->nullable();
            $table->string('jenis_bangunan')->nullable();
            $table->string('kode_bangunan')->nullable();
            $table->string('register')->nullable();

            // Kondisi Fisik
            $table->string('kondisi_bangunan')->nullable();
            $table->string('bertingkat')->nullable(); // Ya/Tidak atau Jumlah
            $table->string('beton')->nullable();      // Ya/Tidak
            $table->decimal('luas_lantai', 20, 2)->nullable();
            $table->string('letak_alamat')->nullable();

            // Dokumen
            $table->date('tanggal')->nullable();
            $table->string('nomor')->nullable();

            // Tanah terkait
            $table->decimal('luas', 20, 2)->nullable(); // Luas Tanah
            $table->string('status_tanah')->nullable();
            $table->string('nomor_kode_tanah')->nullable();

            // Asal Usul & Nilai
            $table->string('asal_usul')->nullable();
            $table->decimal('harga', 20, 2)->nullable();

            // Tambahan
            $table->text('ket')->nullable(); // Menggunakan text karena SQL 'text'
            $table->string('foto')->nullable();
            $table->string('pengurus_user')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bangunan');
    }
};
