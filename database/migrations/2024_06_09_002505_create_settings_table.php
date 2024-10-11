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
            $table->integer('isMaintenance')->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->integer('isDevInteg')->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->integer('isRegStud')->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->integer('isRegLoginStud')->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->integer('isRegInst')->default('0')->comment('0=No, 1=Yes')->nullable();
            $table->integer('isRegAdmins')->default('0')->comment('0=No, 1=Yes')->nullable();
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
