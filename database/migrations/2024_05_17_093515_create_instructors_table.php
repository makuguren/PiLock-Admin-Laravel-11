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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('tag_uid')->unique()->nullable();
            $table->enum('gender', ['0','1','2'])->default('0')->comment('0=None, 1=Male, 2=Female')->nullable();
            $table->string('instructor_theme')->nullable();
            $table->enum('isDefaultPass', ['0','1'])->default('1')->comment('0=No, 1=Yes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
