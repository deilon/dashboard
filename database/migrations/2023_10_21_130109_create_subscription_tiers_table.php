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
            $table->unsignedBigInteger('subscription_plan_id'); // Foreign key to subscription_plans
            // Define the foreign key constraint
            $table->foreign('subscription_plan_id')
            ->references('id')
            ->on('subscription_plans')
            ->onDelete('cascade'); // Define the desired cascade behavior
            $table->string('tier_name');
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
