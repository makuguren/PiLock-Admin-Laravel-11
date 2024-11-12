<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeatsConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seatplan = [
            [0, 0, 40, 39, 38, 37, 0], [0, 36, 35, 0, 0, 0, 0],
            [23, 24, 25, 26, 27, 28, 0], [0, 29, 30, 31, 32, 33, 34],
            [22, 21, 20, 19, 18, 17, 0], [0, 16, 15, 14, 13, 12, 11],
            [1, 2, 3, 4, 5], [0, 6, 7, 8, 9, 10, 0],
        ];

        foreach ($seatplan as $rowIndex => $row) {
            foreach ($row as $columnIndex => $seat) {
                DB::table('seats_configuration')->insert([
                    'seat_number' => $seat,
                    'row' => $rowIndex,
                    'column' => $columnIndex,
                ]);
            }
        }
    }
}
