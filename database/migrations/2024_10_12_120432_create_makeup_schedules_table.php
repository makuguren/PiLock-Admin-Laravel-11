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
        Schema::create('makeup_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->enum('days', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
            $table->time('time_start');
            $table->time('time_end');
            $table->integer('lateDuration')->nullable();
            $table->tinyInteger('isApproved')->default('1')->comment('0=Pending, 1=Approved, 2=Declined');
            $table->tinyInteger('isCurrent')->comment('0=No, 1=Yes');
            $table->tinyInteger('isAttend')->default('0')->comment('0=No, 1=Yes');
            $table->timestamps();

            // Foreign Key
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makeup_schedules');
    }
};
