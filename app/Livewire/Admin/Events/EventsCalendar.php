<?php

namespace App\Livewire\Admin\Events;

use App\Models\Event;
use Livewire\Attributes\On;
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

    //Update the Date of Event by Drag and Drop
    public function onEventDropped($eventId, $year, $month, $day){
        Event::where('id', $eventId)->update(['date' => $year . '-' .$month . '-' . $day]);
        toastr()->success('Event Updated Successfully');
    }
}
