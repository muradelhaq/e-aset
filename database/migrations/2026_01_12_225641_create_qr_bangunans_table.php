<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_bangunans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->foreignId('bangunan_id')
                ->constrained('bangunan') // ✅ SESUAI NAMA TABEL ASLI
                ->cascadeOnDelete();

            $table->string('kode_qr')->unique();
            $table->string('url')->nullable();
            $table->string('qr_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_bangunans');
    }
};
