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
    $scheds_start = Schedules::where('isMakeUp','0')->where('isCurrent', '0')->where('days', $day)->where('time_start', $time);
    $scheds_end = Schedules::where('isMakeUp','0')->where('isCurrent', '1')->where('days', $day)->where('time_end', $time);
    $scheds_now = DB::table('schedule_now')->where('isMakeUp','0')->where('days', $day)->get();

    //Schedules (Make-Up Class) Query
    $makeupscheds_start = Schedules::where('isMakeUp','1')->where('isApproved', '1')->where('isCurrent', '0')->where('days', $day)->where('time_start', $time);
    $makeupscheds_end = Schedules::where('isMakeUp','1')->where('isApproved', '1')->where('isCurrent', '1')->where('days', $day)->where('time_end', $time);
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
        $makeupsched = $makeupscheds_start->first();
        if($makeupsched){
            //Make-Up Schedules
            //Generate Attendance before Executing Regular Schedules
            $users = DB::table('users')->where('section_id', $makeupsched->section_id)->get(); //Sections where scheduled assigned
            $attendanceData = [];

            foreach ($users as $user) {
                $attendanceData[] = [
                    'student_id' => $user->id,
                    'subject_id' => $makeupsched->subject_id,
                    'schedule_id' => $makeupsched->id,
                    'isCurrent' => '1'
                ];
            }
            DB::table('attendances')->insert($attendanceData);

            //Update the Schedule Current = 1
            $makeupscheds_start->update([
                'isCurrent' => '1'
            ]);

            //Update isCurrent to 0 in the Attendance if the Make-Up Classes is Going to Start
            $schedule = Schedules::where('isMakeUp','0')->where('isCurrent', '1')->first();
            if($schedule){
                $users = DB::table('attendances')->where('schedule_id', $schedule->id)->where('isCurrent', '1')->get();
                $attendanceData = [];

                foreach ($users as $user) {
                    $attendanceData[] = [
                        'student_id' => $user->student_id,
                        'isCurrent' => '0'
                    ];
                }

                foreach ($attendanceData as $data) {
                    DB::table('attendances')->where('student_id', $data['student_id'])->update([
                        'isCurrent' => $data['isCurrent']
                    ]);
                }
            }

            //Also, Update isCurrent to 0 in the Regular Class if the Make-Up Classes is Going to Start
            Schedules::where('isMakeUp','0')->where('isCurrent', '1')->update([
                'isCurrent' => '0'
            ]);

        } else {
            //Regular Schedules
            //Generate Attendance before Executing Regular Schedules
            $schedule = $scheds_start->first();
            if($schedule){
                $users = DB::table('users')->where('section_id', $schedule->section_id)->get(); //Sections where scheduled assigned
                $attendanceData = [];

                foreach ($users as $user) {
                    $attendanceData[] = [
                        'student_id' => $user->id,
                        'subject_id' => $schedule->subject_id,
                        'schedule_id' => $schedule->id,
                        'isCurrent' => '1'
                    ];
                }
                DB::table('attendances')->insert($attendanceData);
            }

            //Update the Schedule Current = 1
            $scheds_start->update([
                'isCurrent' => '1'
            ]);
        }
    }

    //Delete EventNow if the Event reaches Event_End
    foreach($events_end as $event){
        if($event_now->isNotEmpty()){
            EventNow::where('event_end', $time)->delete();
            info('Deleted Successfully');
        }
    }

    //Update isCurrent = 0 if the Regular Schedule reaches Time_End
    $schedule = $scheds_end->first();
    if($schedule){
        $users = DB::table('attendances')->where('schedule_id', $schedule->id)->where('isCurrent', '1')->get();
        $attendanceData = [];

        foreach ($users as $user) {
            $attendanceData[] = [
                'student_id' => $user->student_id,
                'isCurrent' => '0'
            ];
        }

        foreach ($attendanceData as $data) {
            DB::table('attendances')->where('student_id', $data['student_id'])->update([
                'isCurrent' => $data['isCurrent']
            ]);
        }
    }

    //Update isCurrent = 0 if the Regular Schedule is Ended
    $scheds_end->update([
        'isCurrent' => '0'
    ]);

    //Update isCurrent = 0 if the Make-Up Class Schedule reaches Time_End
    $schedule = $makeupscheds_end->first();
    if($schedule){
        $users = DB::table('attendances')->where('schedule_id', $schedule->id)->where('isCurrent', '1')->get();
        $attendanceData = [];

        foreach ($users as $user) {
            $attendanceData[] = [
                'student_id' => $user->student_id,
                'isCurrent' => '0'
            ];
        }

        foreach ($attendanceData as $data) {
            DB::table('attendances')->where('student_id', $data['student_id'])->update([
                'isCurrent' => $data['isCurrent']
            ]);
        }
    }

    //Update isCurrent = 0 if the Make-Up Class Schedule is Ended
    $makeupscheds_end->update([
        'isCurrent' => '0'
    ]);

})->timezone('Asia/Manila')->everySecond();
