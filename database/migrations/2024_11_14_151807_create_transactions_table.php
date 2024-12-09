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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->references('id')->on('receivers')->onDelete('cascade');
            $table->decimal('amount',15,2);
            $table->foreignId('sending_currency_id')->references('id')->on('currenices')->onDelete('cascade');
            $table->foreignId('receiving_currency_id')->references('id')->on('currenices')->onDelete('cascade');
            $table->string('exchange_rate');
            $table->decimal('payable',15,2);
            $table->string('transaction_type');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
