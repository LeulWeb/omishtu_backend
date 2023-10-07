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
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained('enrollments')->references('id')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->references('id')->cascadeOnDelete();
            $table->decimal('unit_price', '10', 2, true);
            $table->date('start_date')->default(now());
            $table->date('end_date');
            $table->enum('status', ['new', 'ongoing', 'completed', 'declined']);
            $table->enum('payment_status', ['unpaid', 'paid', 'refund', 'partial']);
            $table->decimal('paid_amount')->default(0);
            $table->foreignId('batch_id')->nullable()->constrained('batches')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_enrollments');
    }
};
