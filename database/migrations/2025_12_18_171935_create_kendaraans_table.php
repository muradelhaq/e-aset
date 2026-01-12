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
        Schema::create('kendaraans', function (Blueprint $table) {
            // id bigint UNSIGNED NOT NULL
            $table->id();

            // nopol varchar(255) NOT NULL (Wajib diisi)
            $table->string('nopol');

            // Kolom-kolom yang boleh kosong (Nullable)
            $table->string('jenis_kendaraan')->nullable();
            $table->string('jenis')->nullable();
            $table->string('merk')->nullable();
            $table->string('tipe')->nullable();
            $table->string('warna')->nullable();

            // varchar(255) di SQL, jadi pakai string
            $table->string('tahun_pembuatan')->nullable();
            $table->string('isi_silinder')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_bpkb')->nullable();
            $table->string('no_mesin')->nullable();

            // Tipe data DATE
            $table->date('tgl_pajak')->nullable();
            $table->date('tgl_perolehan')->nullable();

            // decimal(15,2) untuk Harga
            $table->decimal('harga', 15, 2)->nullable();

            // Data Pemilik & Dokumen
            $table->string('pemilik')->nullable();
            $table->string('nip')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('no_SK')->nullable();
            $table->string('upload_SK')->nullable(); // Berisi path file
            $table->string('keterangan')->nullable();
            $table->string('foto')->nullable(); // Berisi path file

            // created_at & updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
