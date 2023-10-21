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
        Schema::create('counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('customers')->default(0);
            $table->unsignedMediumInteger('projects')->default(0);
            $table->unsignedMediumInteger('students')->default(0);
            $table->unsignedMediumInteger('courses')->default(0);
            $table->unsignedMediumInteger('staff')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counts');
    }
};
