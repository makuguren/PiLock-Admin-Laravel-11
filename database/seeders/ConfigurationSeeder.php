<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Settings Configuration
        Setting::firstOrCreate([
            'website_title' => 'Pi:Lock | Admin',
            'isMaintenance' => '0',
            'isDevInteg' => '0',
            'isRegStud' => '0',
            'isRegLoginStud' => '0',
            'isRegInst' => '0'
        ]);
    }
}
