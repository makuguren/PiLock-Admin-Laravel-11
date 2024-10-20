<?php

namespace App\Livewire\Archive\Instructor;

use App\Models\Archive\Event;
use Livewire\Component;
use Livewire\Attributes\On;

class Events extends Component
{
    public $eventId, $title, $description, $date, $event_start, $event_end;

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
            return redirect()->to('/archive/instructor/events');
        }
    }

    public function render(){
        return view('livewire.archive.instructor.events');
    }
}
