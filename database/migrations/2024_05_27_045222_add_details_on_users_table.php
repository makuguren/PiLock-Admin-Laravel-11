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
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_id')->unique()->nullable();
            $table->string('tag_uid')->unique()->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('user_theme')->nullable();

            //Foreign Key
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('student_id');
            $table->dropColumn('tag_uid');
            $table->dropColumn('section_id');
            $table->dropColumn('birthdate');
            $table->dropColumn('google_id');
            $table->dropColumn('avatar');
            $table->dropColumn('user_theme');
        });
    }
};
