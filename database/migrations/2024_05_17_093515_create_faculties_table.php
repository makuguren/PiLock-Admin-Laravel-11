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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('tag_uid')->unique()->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->text('avatar')->nullable();
            $table->enum('gender', ['0','1','2'])->default('0')->comment('0=None, 1=Male, 2=Female')->nullable();
            $table->string('faculty_theme')->nullable();
            $table->enum('isDefaultPass', ['0','1'])->default('1')->comment('0=No, 1=Yes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
