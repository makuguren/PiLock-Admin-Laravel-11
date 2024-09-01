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
        Schema::table('instructors', function (Blueprint $table) {
            $table->string('tag_uid')->unique()->nullable();
            $table->tinyInteger('gender')->default('0')->comment('0=None, 1=Male, 2=Female')->nullable();
            $table->string('instructor_theme')->nullable();
            $table->enum('isDefaultPass', ['0', '1'])->default('1')->comment('0=No, 1=Yes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn('tag_uid');
            $table->dropColumn('gender');
            $table->dropColumn('instructor_theme');
            $table->dropColumn('isDefaultPass');
        });
    }
};
