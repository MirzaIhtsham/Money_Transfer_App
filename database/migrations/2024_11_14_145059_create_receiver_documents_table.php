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
        Schema::create('receiver_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receiver_id')->references('id')->on('receivers')->onDelete('cascade');
            $table->string('id_card_front_side');
            $table->string('id_card_back_side');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiver_documents');
    }
};
