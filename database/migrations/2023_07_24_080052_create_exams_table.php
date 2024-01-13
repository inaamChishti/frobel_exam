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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('exam_board')->nullable();
            $table->string('qualification')->nullable();
            $table->string('subject')->nullable();
            $table->string('exam_entry_code')->nullable();
            $table->string('level')->nullable();
            $table->string('optional_code')->nullable();
            $table->unsignedBigInteger('userId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
