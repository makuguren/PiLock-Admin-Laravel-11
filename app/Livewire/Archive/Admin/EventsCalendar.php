<?php

namespace App\Livewire\Archive\Admin;

use Carbon\Carbon;
use App\Models\Archive\Event;
use Livewire\Attributes\On;
use App\Rules\NoEventOverlap;
use Illuminate\Support\Collection;
use Makuguren\LivewireCalendar\LivewireCalendar;

class EventsCalendar extends LivewireCalendar
{
    //Calling or Retrieve the Attributes for Dispatch to Syncronize the Events Table
    #[On('eventSync')]
    //Getting all Events and Calendar View
    public function events() : Collection{
        return Event::all()->map(function ($task) {
            return [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'date' => $task->date,
                'event_start' => $task->event_start,
                'event_end' => $task->event_end
            ];
        });
    }

    //Created an Event
    public function onDayClick($year, $month, $day){
        //Send the dateCalendar to Index.php using Dispatch
        $this->dispatch('getDateCalendar', $year, $month, $day);
    }

    //View Events by Clicking Event to Created
    public function onEventClick($eventId){
        //Send the eventDetails to Index.php using Dispatch
        $this->dispatch('viewEvent', $eventId);
    }

    // //Update the Date of Event by Drag and Drop
    // public function onEventDropped($eventId, $year, $month, $day){
    //     Event::where('id', $eventId)->update(['date' => $year . '-' .$month . '-' . $day]);
    //     toastr()->success('Event Updated Successfully');
    // }

    //Update the Date of Event by Drag and Drop
    public function onEventDropped($eventId, $year, $month, $day){
        $event = Event::find($eventId);

        if (!$event) {
            toastr()->error('Event not found.');
            return;
        }
        // Construct the new date
        $newDate = Carbon::createFromDate($year, $month, $day)->format('Y-m-d');

        // Check for overlap using the custom rule
        $validator = \Validator::make(
            [
                'date' => $newDate,
                'event_start' => $event->event_start,
                'event_end' => $event->event_end,
            ],
            [
                'date' => [new NoEventOverlap($newDate, $event->event_start, $event->event_end)],
            ]
        );

        // If validation fails, display an error message
        if ($validator->fails()) {
            toastr()->error('This event overlaps with another event on the same date and time. Please drag and drop to another date.');
            return;
        }

        // Update the event's date if no overlap is detected
        $event->update(['date' => $newDate]);
        toastr()->success('Event Updated Successfully');
    }
}
