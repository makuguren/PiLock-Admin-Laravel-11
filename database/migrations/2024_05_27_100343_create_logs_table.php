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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('instructor_id');
            $table->time('time')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();

            //Foreign Key
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('subject_id')->references('id')->on('subjects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('instructor_id')->references('id')->on('instructors')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
