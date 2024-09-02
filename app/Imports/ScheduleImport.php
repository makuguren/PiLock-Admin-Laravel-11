<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Schedules;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ScheduleImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        // Find the existing course by its course_code and section details
        $course = Course::where('course_code', $row['course_code'])
                ->whereHas('section', function ($query) use ($row) {
                    $query->where('program', $row['program'])
                            ->where('year', $row['year'])
                            ->where('block', $row['block']);
                })
                ->first();

        // If the course exists, create or update the schedule
        if ($course) {
            return new Schedules([
                'course_id' => $course->id,
                'days' => $row['day'],
                'time_start' => $row['time_start'],
                'time_end' => $row['time_end'],
                'isCurrent' => '0'
            ]);
        }

        return null; // Skip if no match is found
    }

    public function rules(): array
    {
        return [
            '*.course_code' => 'required|string',
            '*.day'         => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            '*.time_start'  => 'required',
            '*.time_end'    => 'required|after:*.time_start',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.course_code.required' => 'Course code is required.',
            '*.day.required'         => 'Day is required.',
            '*.time_start.required'  => 'Start time is required.',
            '*.time_end.after'       => 'End time must be after the start time.',
        ];
    }
}
