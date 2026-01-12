<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_non_elektroniks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('non_elektronik_id')
                ->constrained('non_elektroniks')
                ->cascadeOnDelete();

            $table->string('kode_qr')->unique();
            $table->string('url');
            $table->string('qr_path')->nullable();

            $table->timestamps();

            // Mencegah 1 barang punya lebih dari 1 QR
            $table->unique('non_elektronik_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_non_elektroniks');
    }
};
