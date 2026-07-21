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
        Schema::table('infos', function (Blueprint $table) {
            $table->text('teks_arab')->nullable()->after('deskripsi');
            $table->string('salam_pembuka')->nullable()->after('teks_arab');
            $table->text('teks_pembuka')->nullable()->after('salam_pembuka');
            $table->text('teks_penutup')->nullable()->after('teks_pembuka');
            $table->string('salam_penutup')->nullable()->after('teks_penutup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('infos', function (Blueprint $table) {
            $table->dropColumn(['teks_arab', 'salam_pembuka', 'teks_pembuka', 'teks_penutup', 'salam_penutup']);
        });
    }
};
