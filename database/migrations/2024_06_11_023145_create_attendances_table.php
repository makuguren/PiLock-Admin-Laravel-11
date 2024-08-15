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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unSignedBigInteger('course_id');
            $table->date('date')->nullable();
            $table->time('time_end')->nullable();
            $table->integer('isPresent')->default('0')->comment('0=Absent, 1=Present')->nullable();
            $table->integer('isCurrent')->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->timestamps();

            //Foreign Key
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
