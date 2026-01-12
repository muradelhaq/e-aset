<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('elektronik', function (Blueprint $table) {
            $table->id();

            $table->string('jenis_barang')->nullable();
            $table->string('merk')->nullable();
            $table->string('tipe')->nullable();
            $table->string('warna', 50)->nullable();
            $table->string('spek')->nullable();
            $table->string('no_seri', 100)->nullable();

            $table->date('tgl_perolehan')->nullable();

            $table->decimal('harga', 20, 2)->nullable();

            $table->string('kondisi', 50)->nullable();
            $table->string('pemilik')->nullable();

            $table->text('keterangan')->nullable();

            $table->string('foto')->nullable();

            $table->string('no_sk', 100)->nullable();
            $table->string('upload_SK')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elektronik');
    }
};
