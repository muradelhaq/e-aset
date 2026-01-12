<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_elektroniks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elektronik_id')->constrained('elektronik')->onDelete('cascade');
            $table->date('tanggal_service')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('biaya', 15, 2)->nullable();
            $table->timestamps();

            $table->index('elektronik_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_elektroniks');
    }
};
