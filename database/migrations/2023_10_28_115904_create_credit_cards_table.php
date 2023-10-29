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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id'); // Foreign key to subscription_plans
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define the foreign key constraint

            $table->unsignedBigInteger('subscription_id'); // Foreign key to subscription_plans
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade'); // Define the foreign key constraint
            
            $table->string('credit_card_number'); // Complete credit card number
            $table->string('valid_thru_month'); // Two digits for the month (e.g., 01-12)
            $table->string('valid_thru_year'); // Two digits for the year (e.g., 22 for 2022)
            $table->string('cvv_cvc'); // CVV and CVC 3-4 digits
            $table->string('cardholder_name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};
