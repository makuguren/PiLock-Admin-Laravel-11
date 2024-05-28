<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventNow;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

Schedule::call(function () {
    $datetime = Carbon::now('Asia/Manila');
    $day = $datetime->format('l');
    $time = $datetime->toTimeString();
    $date = $datetime->toDateString();

    //Events Query
    $events_start = Event::where('date', $date)->where('event_start', $time)->get();
    $events_end = Event::where('date', $date)->where('event_end', $time)->get();
    $event_now = EventNow::where('date', $date)->get();

    //Schedules Query
    $scheds_start = Schedule::where('days', $day)->where('time_start', $time)->get();
    $scheds_end = Schedule::where('days', $day)->where('time_end', $time)->get();
    $scheds_now = DB::table('schedule_now')->where('days', $day)->get();

    //Checking if the Events is !Empty then Proceed to Events else Proceed to Schedules
    if($events_start->isNotEmpty()){
        //Events Code Here
        foreach($events_start as $event){
            if($event_now->isEmpty()){
                //Create Events to EventNow
                EventNow::create([
                    'title' => $event->title,
                    'description' => $event->description,
                    'date' => $event->date,
                    'event_start' => $event->event_start,
                    'event_end' => $event->event_end
                ]);
            } else {
                //Update Data to EventNow
                EventNow::where('date', $date)->update([
                    'title' => $event->title,
                    'description' => $event->description,
                    'date' => $event->date,
                    'event_start' => $event->event_start,
                    'event_end' => $event->event_end
                ]);
            }

            //Delete ScheduleNow if the Events is Going to Start
            if($scheds_now->isNotEmpty()){
                DB::table('schedule_now')->delete();
                info('Deleted Successfully');
            }
        }
    } else {
        foreach ($scheds_start as $sched) {
            if($scheds_now->isEmpty()){
                //Create Schedules
                DB::table('schedule_now')->insert([
                    'subject_id' => $sched->subject_id,
                    'instructor_id' => $sched->instructor_id,
                    'section_id' => $sched->section_id,
                    'days' => $sched->days,
                    'time_start' => $sched->time_start,
                    'time_end' => $sched->time_end
                ]);
            } else {
                //Update Schedules
                DB::table('schedule_now')->where('days', $day)->update([
                    'subject_id' => $sched->subject_id,
                    'instructor_id' => $sched->instructor_id,
                    'section_id' => $sched->section_id,
                    'days' => $sched->days,
                    'time_start' => $sched->time_start,
                    'time_end' => $sched->time_end
                ]);
                // info('Update Done');
            }
        }
    }

    //Delete EventNow if the Event reaches Event_End
    foreach($events_end as $event){
        if($event_now->isNotEmpty()){
            EventNow::where('event_end', $time)->delete();
            info('Deleted Successfully');
        }
    }

    //Delete ScheduleNow if the Schedules reaches Event_End
    foreach ($scheds_end as $sched) {
        if($scheds_now->isNotEmpty()){
            DB::table('schedule_now')->where('time_end', $time)->delete();
            info('Deleted Successfully');
        }
    }

})->timezone('Asia/Manila')->everySecond();
