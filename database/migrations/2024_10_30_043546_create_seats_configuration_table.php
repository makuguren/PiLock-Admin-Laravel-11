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
        Schema::create('seats_configuration', function (Blueprint $table) {
            $table->id();
            $table->integer('seat_number')->nullable();
            $table->integer('row')->nullable();
            $table->integer('column')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats_configuration');
    }
};
