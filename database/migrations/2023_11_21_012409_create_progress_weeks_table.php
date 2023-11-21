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
        Schema::create('progress_weeks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // Foreign key to subscription_plans
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define the foreign key constraint

            $table->unsignedInteger('week_number');
            $table->string('week_title', 100);
            $table->enum('status', ['active', 'completed']);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('author', ['staff', 'member']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_weeks');
    }
};
