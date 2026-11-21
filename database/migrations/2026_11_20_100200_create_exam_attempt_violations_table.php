<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempt_violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_attempt_id')->constrained()->cascadeOnDelete();
            $table->string('type', 30);
            $table->timestamp('occurred_at');
            $table->index(['exam_attempt_id', 'occurred_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempt_violations');
    }
};
