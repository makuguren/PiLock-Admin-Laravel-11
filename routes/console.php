<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventNow;
use App\Models\Schedules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $datetime = Carbon::now('Asia/Manila');
    $day = $datetime->format('l');
    $time = $datetime->toTimeString();
    $date = $datetime->toDateString();

    //Events Query
    $events_start = Event::where('date', $date)->where('event_start', $time)->get();
    $events_end = Event::where('date', $date)->where('event_end', $time)->get();
    $event_now = EventNow::where('date', $date)->get();

    //Schedules (Regular Class) Query
    $scheds_start = Schedules::where('isMakeUp','0')->where('days', $day)->where('time_start', $time)->get();
    $scheds_end = Schedules::where('isMakeUp','0')->where('days', $day)->where('time_end', $time)->get();
    $scheds_now = DB::table('schedule_now')->where('isMakeUp','0')->where('days', $day)->get();

    //Schedules (Make-Up Class) Query
    $makeupscheds_start = Schedules::where('isMakeUp','1')->where('isApproved', '1')->where('days', $day)->where('time_start', $time)->get();
    $makeupscheds_end = Schedules::where('isMakeUp','1')->where('isApproved', '1')->where('days', $day)->where('time_end', $time)->get();
    $makeupscheds_now = DB::table('schedule_now')->where('isMakeUp','1')->where('isApproved', '1')->where('days', $day)->get();

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
                    'event_end' => $event->event_end,
                    'isMakeUp' => '0'
                ]);
            } else {
                //Update Data to EventNow
                EventNow::where('date', $date)->update([
                    'title' => $event->title,
                    'description' => $event->description,
                    'date' => $event->date,
                    'event_start' => $event->event_start,
                    'event_end' => $event->event_end,
                    'isMakeUp' => '0'
                ]);
            }

            //Delete Regular Schedule if the Events is Going to Start
            if($scheds_now->isNotEmpty()){
                DB::table('schedule_now')->where('isMakeUp','0')->delete();
                info('Deleted Successfully');
            }

            //Delete Make-Up Class if the Events is Going to Start
            if($makeupscheds_now->isNotEmpty()){
                DB::table('schedule_now')->where('isMakeUp','1')->delete();
                info('Deleted Successfully');
            }
        }
    } else {
        if($makeupscheds_start->isNotEmpty()){
            info('MakeUp Classes');
            //Make-Up Schedules
            foreach($makeupscheds_start as $makeup){
                if($makeupscheds_now->isEmpty()){
                    //Create Make-Up Schedules
                    DB::table('schedule_now')->insert([
                        'subject_id' => $makeup->subject_id,
                        'instructor_id' => $makeup->instructor_id,
                        'section_id' => $makeup->section_id,
                        'days' => $makeup->days,
                        'time_start' => $makeup->time_start,
                        'time_end' => $makeup->time_end,
                        'isMakeUp' => $makeup->isMakeUp
                    ]);
                } else {
                    //Update Make-Up Schedules
                    DB::table('schedule_now')->where('days', $day)->update([
                        'subject_id' => $makeup->subject_id,
                        'instructor_id' => $makeup->instructor_id,
                        'section_id' => $makeup->section_id,
                        'days' => $makeup->days,
                        'time_start' => $makeup->time_start,
                        'time_end' => $makeup->time_end,
                        'isMakeUp' => $makeup->isMakeUp
                    ]);
                    // info('Update Done');
                }

                //Delete Regular Class if the Make-Up Classes is Going to Start
                if($scheds_now->isNotEmpty()){
                    DB::table('schedule_now')->where('isMakeUp','0')->delete();
                    info('Deleted Successfully');
                }
            }
        } else {
            //Regular Schedules
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
    }

    //Delete EventNow if the Event reaches Event_End
    foreach($events_end as $event){
        if($event_now->isNotEmpty()){
            EventNow::where('event_end', $time)->delete();
            info('Deleted Successfully');
        }
    }

    //Delete ScheduleNow if the Regular Schedule reaches Time_End
    foreach ($scheds_end as $sched) {
        if($scheds_now->isNotEmpty()){
            DB::table('schedule_now')->where('isMakeUp','0')->where('time_end', $time)->delete();
            info('Deleted Successfully');
        }
    }

    //Delete ScheduleNow also the Schedule View if the Make-Up Schedule reaches Time_End
    foreach ($makeupscheds_end as $makeup) {
        if($makeupscheds_now->isNotEmpty()){
            DB::table('schedules')->where('isMakeUp','1')->where('days', $day)->where('time_end', $time)->delete();
            DB::table('schedule_now')->where('isMakeUp','1')->where('time_end', $time)->delete();
            info('Deleted Successfully');
        }
    }

})->timezone('Asia/Manila')->everySecond();
