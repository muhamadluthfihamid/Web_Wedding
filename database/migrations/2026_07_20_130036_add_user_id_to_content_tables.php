<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah user_id ke tabel infos
        Schema::table('infos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')
                  ->constrained()->onDelete('cascade');
        });

        // Tambah user_id ke tabel stories
        Schema::table('stories', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')
                  ->constrained()->onDelete('cascade');
        });

        // Tambah user_id ke tabel galleries
        Schema::table('galleries', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')
                  ->constrained()->onDelete('cascade');
        });

        // Tambah user_id ke tabel biodata_prias
        Schema::table('biodata_prias', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')
                  ->constrained()->onDelete('cascade');
        });

        // Tambah user_id ke tabel biodata_wanitas
        Schema::table('biodata_wanitas', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')
                  ->constrained()->onDelete('cascade');
        });

        // Tambah user_id ke tabel gifts
        Schema::table('gifts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')
                  ->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        foreach (['infos', 'stories', 'galleries', 'biodata_prias', 'biodata_wanitas', 'gifts'] as $tbl) {
            Schema::table($tbl, function (Blueprint $table) use ($tbl) {
                $table->dropForeign([$tbl === 'gifts' ? 'gifts_user_id_foreign' : "{$tbl}_user_id_foreign"]);
                $table->dropColumn('user_id');
            });
        }
    }
};
