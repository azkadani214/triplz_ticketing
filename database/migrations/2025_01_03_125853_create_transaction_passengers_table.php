<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_passengers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id'); // Pastikan tipe data sesuai
            $table->unsignedBigInteger('flight_seat_id');
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->softDeletes();
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transaction_flights')
                ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('transaction_passengers');
    }
};
