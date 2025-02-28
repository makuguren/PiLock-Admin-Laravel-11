<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Section;
use App\Models\Faculty;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CourseImport implements ToModel, WithHeadingRow, WithValidation
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
        $instructor = Faculty::where('first_name', $row['instructor_fname'])->where('last_name', $row['instructor_lname'])->first();

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

    public function rules(): array
    {
        return [
            '*.course_code'      => 'required|string',
            '*.course_title'     => 'required|string|max:255',
            '*.instructor_fname'  => 'required|string|exists:instructors,first_name',
            '*.instructor_lname'  => 'required|string|exists:instructors,last_name',
            '*.program'          => 'required|string|in:BSIT,BSCS,BLIS,BSIS', // Add other valid programs as needed
            '*.year'             => 'required|integer|between:1,4',
            '*.block'            => 'required|string|size:1|alpha',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.course_code.required' => 'Course code is required.',
            '*.course_title.required' => 'Course title is required.',
            '*.instructor_fname.exists' => 'Instructor First Name must exist in the database.',
            '*.instructor_lname.exists' => 'Instructor Last Name must exist in the database.',
            '*.program.in'            => 'Program must be BSIT or other valid codes.',
            '*.year.between'          => 'Year must be between 1 and 4.',
            '*.block.alpha'           => 'Block must be a single letter.',
        ];
    }
}
