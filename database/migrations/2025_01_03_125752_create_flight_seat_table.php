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
    {Schema::create('flight_seat', function (Blueprint $table) {
        $table->id();
        $table->foreignId('flight_id')->constrained('flights')->cascadeOnDelete();  // Menentukan tabel flights
        $table->string('row');
        $table->string('columns');
        $table->enum('class_type', ['economy', 'business']);
        $table->boolean('is_available')->default(false);  // koreksi typo
        $table->softDeletes();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_seat');
    }
};
