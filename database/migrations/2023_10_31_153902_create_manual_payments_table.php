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
        Schema::create('manual_payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // Foreign key to subscription_plans
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define the foreign key constraint

            $table->unsignedBigInteger('subscription_id'); // Foreign key to subscription_plans
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade'); // Define the foreign key constraint

            $table->string('full_name', 100);
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_payments');
    }
};
