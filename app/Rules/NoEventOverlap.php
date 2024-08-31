<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Event;
use Carbon\Carbon;

class NoEventOverlap implements Rule
{
    protected $date;
    protected $eventStart;
    protected $eventEnd;

    public function __construct($date, $eventStart, $eventEnd)
    {
        $this->date = $date;
        $this->eventStart = $eventStart;
        $this->eventEnd = $eventEnd;
    }

    public function passes($attribute, $value)
    {
        // Check for overlapping events on the same date
        return !Event::where('date', $this->date)
            ->where(function ($query) {
                $query->whereBetween('event_start', [$this->eventStart, $this->eventEnd])
                    ->orWhereBetween('event_end', [$this->eventStart, $this->eventEnd])
                    ->orWhere(function ($query) {
                        $query->where('event_start', '<=', $this->eventStart)
                              ->where('event_end', '>=', $this->eventEnd);
                    });
            })
            ->exists();
    }

    public function message()
    {
        return 'This event overlaps with another event on the same date and time. Please change another event date and time.';
    }
}
