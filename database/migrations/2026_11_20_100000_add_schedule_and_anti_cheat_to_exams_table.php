<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dateTime('starts_at')->nullable()->after('status');
            $table->dateTime('ends_at')->nullable()->after('starts_at');
            $table->boolean('anti_cheat_enabled')->default(false)->after('ends_at');
            $table->unsignedTinyInteger('max_violations')->default(3)->after('anti_cheat_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn(['starts_at', 'ends_at', 'anti_cheat_enabled', 'max_violations']);
        });
    }
};
