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
        Schema::create('course_icon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('icons_id')->constrained('icons')->references('id')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_icon');
    }
};
