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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code');
            $table->string('course_title');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->string('course_key');
            $table->timestamps();

            // Foreign Key
            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('instructor_id')->references('id')->on('instructors')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
