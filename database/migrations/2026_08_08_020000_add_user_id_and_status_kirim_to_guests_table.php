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
        Schema::table('guests', function (Blueprint $table) {
            if (!Schema::hasColumn('guests', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('guests', 'status_kirim')) {
                $table->boolean('status_kirim')->default(false)->after('keterangan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            if (Schema::hasColumn('guests', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('guests', 'status_kirim')) {
                $table->dropColumn('status_kirim');
            }
        });
    }
};
