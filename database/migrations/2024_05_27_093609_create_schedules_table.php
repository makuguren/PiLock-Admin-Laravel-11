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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('section_id');
            $table->string('days');
            $table->time('time_start');
            $table->time('time_end');
            $table->tinyInteger('isMakeUp')->default('0')->comment('0=Regular, 1=MakeUp');
            $table->tinyInteger('isApproved')->default('1')->comment('0=Pending, 1=Approved, 2=Declined');
            $table->tinyInteger('isCurrent')->default('0')->comment('0=No, 1=Yes');
            $table->tinyInteger('isAttend')->default('0')->comment('0=No, 1=Yes');
            $table->timestamps();

            // Foreign Key
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('instructor_id')->references('id')->on('instructors');
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
