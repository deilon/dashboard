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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to subscription_plans
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define the foreign key constraint
            
            $table->unsignedBigInteger('subscription_arrangement_id'); // Foreign key to subscription_plans
            $table->foreign('subscription_arrangement_id')->references('id')->on('subscription_arrangements')->onDelete('cascade'); // Define the foreign key constraint

            $table->unsignedBigInteger('subscription_tier_id'); // Foreign key to subscription_plans
            $table->foreign('subscription_tier_id')->references('id')->on('subscription_tiers')->onDelete('cascade'); // Define the foreign key constraint
            
            $table->string('staff_assigned_id')->nullable();
            $table->index('staff_assigned_id');

            $table->date('start_date');
            $table->date('end_date');
            
            $table->decimal('amount_paid', 10, 2);
            $table->enum('payment_option', ['credit card', 'gcash', 'manual payment']);
            $table->enum('status', ['active', 'expired', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
