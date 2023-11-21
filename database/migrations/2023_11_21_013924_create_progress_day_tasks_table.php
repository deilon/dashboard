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
        Schema::create('progress_day_tasks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('progress_day_id'); // Foreign key to subscription_plans
            $table->foreign('progress_day_id')->references('id')->on('progress_days')->onDelete('cascade'); // Define the foreign key constraint

            $table->string('task_title', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_day_tasks');
    }
};
