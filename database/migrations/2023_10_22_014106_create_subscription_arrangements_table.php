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
        Schema::create('subscription_arrangements', function (Blueprint $table) {
            $table->id();
            $table->string('arrangement_name');
            $table->enum('status', ['active', 'disabled']);
            $table->enum('countdown', ['active', 'disabled']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_arrangements');
    }
};
