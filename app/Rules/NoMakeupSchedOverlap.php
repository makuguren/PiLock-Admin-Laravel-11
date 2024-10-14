<?php

namespace App\Rules;

use App\Models\Schedules;
use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class NoMakeupSchedOverlap implements Rule
{
    protected $course_id;
    protected $day;
    protected $time_start;
    protected $time_end;

    public function __construct($course_id, $day, $time_start, $time_end)
    {
        $this->course_id = $course_id;
        $this->day = $day;
        $this->time_start = $time_start;
        $this->time_end = $time_end;
    }

    public function passes($attribute, $value)
    {
        // Parse the start and end times into Carbon instances
        $timeStart = Carbon::parse($this->time_start)->format('H:i:s');
        $timeEnd = Carbon::parse($this->time_end)->format('H:i:s');

        // Query to find overlapping schedules (ignoring course_id)
        $checkOverlap = Schedules::where('days', $this->day)
            ->where(function ($query) use ($timeStart, $timeEnd) {
                $query->where(function ($subQuery) use ($timeStart, $timeEnd) {
                    // Case 1: New schedule's start time falls within an existing schedule
                    $subQuery->where('time_start', '<=', $timeStart)
                             ->where('time_end', '>', $timeStart);
                })
                ->orWhere(function ($subQuery) use ($timeStart, $timeEnd) {
                    // Case 2: New schedule's end time falls within an existing schedule
                    $subQuery->where('time_start', '<', $timeEnd)
                             ->where('time_end', '>=', $timeEnd);
                })
                ->orWhere(function ($subQuery) use ($timeStart, $timeEnd) {
                    // Case 3: New schedule completely envelops an existing schedule
                    $subQuery->where('time_start', '>=', $timeStart)
                             ->where('time_end', '<=', $timeEnd);
                });
            })
            ->exists();

        return !$checkOverlap;
    }

    public function message()
    {
        return 'Makeup: This schedule overlaps with an existing schedule on the same day and time.';
    }
}
