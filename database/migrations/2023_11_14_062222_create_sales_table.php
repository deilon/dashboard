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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('subscription_id'); // Foreign key to subscription_plans
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade'); // Define the foreign key constraint
            
            $table->string('subscription_arrangement');
            $table->string('tier_name');
            $table->date('date');
            $table->string('payment_method');
            $table->string('customer_name');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
