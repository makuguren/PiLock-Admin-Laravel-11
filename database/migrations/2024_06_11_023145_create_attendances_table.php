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
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unSignedBigInteger('course_id')->nullable();
            $table->time('time_attend')->nullable();
            $table->date('date')->nullable();
            $table->time('time_end')->nullable();
            $table->enum('isPresent', ['0','1'])->default('0')->comment('0=Absent, 1=Present')->nullable();
            $table->enum('isCurrent', ['0','1'])->comment('0=No, 1=Yes')->nullable();
            $table->enum('isMakeUp', ['0','1'])->comment('0=Regular, 1=MakeUp')->nullable();
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
