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
        Schema::create('subscription_tiers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_arrangement_id'); // Foreign key to subscription_plans
            $table->foreign('subscription_arrangement_id')->references('id')->on('subscription_arrangements')->onDelete('cascade'); // Define the foreign key constraint
            $table->string('tier_name');
            $table->enum('duration', ['2 Months', '3 Months', '6 Months', '12 Months']);
            $table->decimal('price', 10, 2);
            $table->enum('status', ['active', 'disabled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_tiers');
    }
};
