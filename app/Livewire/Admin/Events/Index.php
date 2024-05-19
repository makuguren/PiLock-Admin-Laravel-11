<?php

namespace App\Livewire\Admin\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $title, $description, $date, $event_start, $event_end, $eventId;

    //Calling or Retrieve the Attributes for Dispatch to Retrieve the CalDate Data from EventsCalendar.php
    #[On('getDateCalendar')]
    //Getter and Date from Calendar and Call into another Functions
    public function getDate($year, $month, $day = null){
        $this->date = $year . '/' . $month . '/' . $day;
    }

    //Validations
    protected function rules(){
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required',
            'event_start' => 'required',
            'event_end' => 'required'
        ];
    }

    public function updated($fields){
        $this->validateOnly($fields);
    }
    //Validations End

    //Save Event
    public function saveEvent(){
        $validatedData = $this->validate();

        $event = Event::create($validatedData);
        toastr()->success('Event Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');

        //Syncronize the Data to Eventscalendar.php
        $this->dispatch('eventSync', $event);
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
            return redirect()->to('/events');
        }
    }

    //Update Event
    public function updateEvent(){
        $validatedData = $this->validate();

        $event = Event::where('id', $this->eventId)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'event_start' => $validatedData['event_start'],
            'event_end' => $validatedData['event_end']
        ]);

        toastr()->success('Instructor Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');

        //Syncronize the Data to Eventscalendar.php
        $this->dispatch('eventSync', $event);
    }

    //Delete Event
    public function destroyEvent(){
        // dd($this->eventId);
        $event = Event::find($this->eventId)->delete();
        toastr()->success('Event Deleted Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');

        //Syncronize the Data to Eventscalendar.php
        $this->dispatch('eventSync', $event);
    }

    public function resetInput(){
        $this->title = '';
        $this->description = '';
        $this->date = '';
        $this->event_start = '';
        $this->event_end = '';
    }

    public function render(){
        return view('livewire.admin.events.index');
    }
}
