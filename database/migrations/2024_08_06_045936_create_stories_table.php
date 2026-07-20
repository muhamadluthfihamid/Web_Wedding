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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->text('deskripsi');
            $table->string('judul_bertemu');
            $table->string('tgl_bertemu');
            $table->text('note_bertemu');
            $table->string( 'foto_bertemu')->nullable();
            $table->string('judul_serius');
            $table->date('tgl_serius');
            $table->text('note_serius');
            $table->string('foto_serius')->nullable();
            $table->string('judul_tunangan');
            $table->date('tgl_tunangan');
            $table->text('note_tunangan');
            $table->string('foto_tunangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
