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
        Schema::create('progress_days', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('progress_week_id'); // Foreign key to subscription_plans
            $table->foreign('progress_week_id')->references('id')->on('progress_weeks')->onDelete('cascade'); // Define the foreign key constraint

            $table->enum('day_number', ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7']);
            $table->string('day_title', 100);
            $table->enum('status', ['active', 'completed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_days');
    }
};
