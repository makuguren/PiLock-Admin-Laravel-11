<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function showEventsAPI(){
        $events = Event::all();
        if($events->count() > 0){
            return response()->json([
                'events' => $events->map(function ($events) {
                    return [
                        'id' => $events->id,
                        'title' => $events->title,
                        'description' => $events->description,
                        'date' => $events->date,
                        'event_start' => $events->event_start,
                        'event_end' => $events->event_end,
                        'isCurrent' => $events->isCurrent
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Events Found'
            ], 404);
        }
    }
}
