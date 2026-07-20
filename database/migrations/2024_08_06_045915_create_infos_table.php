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
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengantin_istri');
            $table->string('nama_pengantin_pria');
            $table->date('tanggal_pernikahan');
            $table->time('mulai_akad');
            $table->time('selesai_akad');
            $table->time('mulai_resepsi');
            $table->string('alamat');
            $table->text('deskripsi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infos');
    }
};