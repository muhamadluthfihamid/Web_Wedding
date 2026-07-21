<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                          // "Basic" / "Premium"
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('harga');             // dalam Rupiah
            $table->unsignedInteger('durasi_hari');          // 90 / 180
            $table->json('fitur')->nullable();               // list fitur
            $table->boolean('is_aktif')->default(true);
            $table->string('warna_badge')->default('indigo'); // untuk UI
            $table->boolean('is_populer')->default(false);   // badge "Terpopuler"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_packages');
    }
};
