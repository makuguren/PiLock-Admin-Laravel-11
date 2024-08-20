<?php

namespace App\Imports;

use App\Models\Schedules;
use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScheduleImport implements ToModel, WithHeadingRow
{
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
            ]);
        }

        return null; // Skip if no match is found
    }
}
