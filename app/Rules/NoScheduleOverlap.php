<?php

namespace App\Rules;

use App\Models\Schedules;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class NoScheduleOverlap implements Rule
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
        // Check for exact duplicates (only needed if course_id is the same)
        $exactDuplicate = Schedules::where('course_id', $this->course_id)
            ->where('days', $this->day)
            ->where('time_start', $this->time_start)
            ->where('time_end', $this->time_end)
            ->exists();

        // Query where Exact match found
        if ($exactDuplicate) {
            return false;
        }

        // Query to find overlapping schedules (ignoring course_id)
        $overlap = Schedules::where('days', $this->day)
            ->where(function($query) {
                $query->whereBetween('time_start', [$this->time_start, $this->time_end])
                      ->orWhereBetween('time_end', [$this->time_start, $this->time_end])
                      ->orWhere(function($query) {
                          $query->where('time_start', '<=', $this->time_start)
                                ->where('time_end', '>=', $this->time_end);
                      });
            })
            ->exists();

        return !$overlap;
    }

    public function message()
    {
        return 'This schedule overlaps with an existing schedule on the same day and time. Please change your schedules day and time.';
    }
}
