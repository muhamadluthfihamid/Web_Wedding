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
        Schema::table('biodata_prias', function (Blueprint $table) {
            $table->string('asal')->nullable()->after('deskripsi');
        });

        Schema::table('biodata_wanitas', function (Blueprint $table) {
            $table->string('asal')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata_prias', function (Blueprint $table) {
            $table->dropColumn('asal');
        });

        Schema::table('biodata_wanitas', function (Blueprint $table) {
            $table->dropColumn('asal');
        });
    }
};
