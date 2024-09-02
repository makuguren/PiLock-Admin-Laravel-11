<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Section;
use App\Models\Instructor;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        // Find or create the section based on program, year, and block
        $section = Section::firstOrCreate(
            [
                'program' => $row['program'],
                'year' => $row['year'],
                'block' => $row['block']
            ],
            [
                'program' => $row['program'],
                'year' => $row['year'],
                'block' => $row['block']
            ]
        );

        // Find the existing instructor based on instructor name
        $instructor = Instructor::where('name', $row['instructor_name'])->first();

        // If the instructor exists, create or update the course
        if ($instructor) {
            return new Course([
                'course_code' => $row['course_code'],
                'course_title' => $row['course_title'],
                'section_id' => $section->id,
                'instructor_id' => $instructor->id,
                'course_key' => Crypt::encryptString(str_replace(' ', '', $row['course_code']) . $row['program'] . $row['year'] . $row['block'])
            ]);
        }

        return null; // Skip if no match is found
    }
}
