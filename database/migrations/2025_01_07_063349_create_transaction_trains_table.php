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
        Schema::create('transaction_trains', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('train_id')->constrained()->cascadeOnDelete();
            $table->foreignId('train_class_id')->constrained('train_classes')->cascadeOnDelete(); // Explicit table name
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('number_of_passengers');
            $table->foreignId('promo_code_id')->nullable()->constrained('promo_codes')->nullOnDelete(); // Explicit table name
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->integer('subtotal')->nullable();
            $table->unsignedBigInteger('grandtotal')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_trains');
    }
};
