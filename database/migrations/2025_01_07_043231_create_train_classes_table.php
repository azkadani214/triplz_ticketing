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
        Schema::create('train_classes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('train_id')->constrained('trains')->cascadeOnDelete();
        $table->string('class_name');
        $table->decimal('price', 10, 2);
        $table->timestamps();
        $table->softDeletes();
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train_classes');
    }
};
