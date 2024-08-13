<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionsSeeder extends Seeder
{
    public function run(): void
    {
        // Programs
        $programs = [
            'BSIT',
            'BSCS',
            'BSIS',
            'BLIS'
        ];

        foreach ($programs as $program) {
            Program::create([
                'program_nane' => $program
            ]);
        }
    }
}
