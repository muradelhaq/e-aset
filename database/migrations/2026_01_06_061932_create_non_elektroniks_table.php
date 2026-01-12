<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('non_elektroniks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->string('jenis_barang');
            $table->string('nama_barang');
            $table->string('bahan')->nullable();
            $table->string('warna')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('merk')->nullable();

            $table->date('tgl_perolehan')->nullable();
            $table->decimal('harga', 15, 2)->nullable();

            $table->string('kondisi')->nullable();
            $table->string('pemilik')->nullable();
            $table->text('keterangan')->nullable();

            $table->string('foto')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('upload_sk')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_non_elektroniks');
    }
};
