<?php

namespace App\Livewire\Archive\Admin;

use App\Models\Archive\Event;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\QueryException;
use App\Rules\NoEventOverlap;

class Events extends Component
{
    public $title, $description, $date, $event_start, $event_end, $eventId;

    //Calling or Retrieve the Attributes for Dispatch to Retrieve the CalDate Data from EventsCalendar.php
    #[On('getDateCalendar')]
    //Getter and Date from Calendar and Call into another Functions
    public function getDate($year, $month, $day = null){
        $this->date = $year . '/' . $month . '/' . $day;
    }

    //Calling or Retrieve the Attributes for Dispatch to Retrieve the Event Data from EventsCalendar.php
    #[On('viewEvent')]

    //View Event
    public function viewEvent($eventId = null){
        $event = Event::findOrFail($eventId);

        if($event){
            $this->eventId = $event->id;
            $this->title = $event->title;
            $this->description = $event->description;
            $this->date = $event->date;
            $this->event_start = $event->event_start;
            $this->event_end = $event->event_end;
        } else {
            return redirect()->to('/archive/events');
        }
    }

    public function render(){
        return view('livewire.archive.admin.events');
    }
}
