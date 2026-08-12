<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('event_type')->default('wedding')->after('rental_package_id');
            $table->foreignId('theme_id')->nullable()->after('event_type')->constrained('themes')->onDelete('set null');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('event_type')->default('wedding')->after('role');
            $table->foreignId('theme_id')->nullable()->after('event_type')->constrained('themes')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['theme_id']);
            $table->dropColumn(['event_type', 'theme_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['theme_id']);
            $table->dropColumn(['event_type', 'theme_id']);
        });
    }
};
