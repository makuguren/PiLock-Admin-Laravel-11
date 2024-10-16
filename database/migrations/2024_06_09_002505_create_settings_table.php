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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_title')->nullable();
            $table->enum('isMaintenance', ['0','1'])->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->enum('isDevInteg', ['0','1'])->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->enum('isRegStud', ['0','1'])->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->enum('isRegLoginStud', ['0','1'])->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->enum('isRegInst', ['0','1'])->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->enum('isRegAdmins', ['0','1'])->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
