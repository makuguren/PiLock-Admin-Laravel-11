<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Schedules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $datetime = Carbon::now('Asia/Manila');
    $day = $datetime->format('l');
    $time = $datetime->toTimeString();
    $date = $datetime->toDateString();

    //Events Query
    $events_start = Event::where('isCurrent', '0')->where('date', $date)->where('event_start', $time);
    $events_end = Event::where('isCurrent', '1')->where('date', $date)->where('event_end', $time);

    //Schedules (Regular Class) Query
    $scheds_start = Schedules::where('isMakeUp','0')->where('isCurrent', '0')->where('days', $day)->where('time_start', $time);
    $scheds_end = Schedules::where('isMakeUp','0')->where('isCurrent', '1')->where('days', $day)->where('time_end', $time);

    //Schedules (Make-Up Class) Query
    $makeupscheds_start = Schedules::where('isMakeUp','1')->where('isApproved', '1')->where('isCurrent', '0')->where('days', $day)->where('time_start', $time);
    $makeupscheds_end = Schedules::where('isMakeUp','1')->where('isApproved', '1')->where('isCurrent', '1')->where('days', $day)->where('time_end', $time);

    //Checking if the Events is !Empty then Proceed to Events else Proceed to Schedules
    $event = $events_start->first();
    if($event){
        //Events Code Here
        //Update the Event isCurrent = 1
        $events_start->update([
            'isCurrent' => '1'
        ]);

        //Update isCurrent to 0 in the Attendance for Make-Up Class if the Event is Going to Start
        $schedule = Schedules::where('isMakeUp','1')->where('isCurrent', '1')->first();
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

        //Also, Update isCurrent to 0 in the Make-Up Class if the Event is Going to Start
        Schedules::where('isMakeUp','1')->where('isCurrent', '1')->update([
            'isCurrent' => '0',
            'isAttend' => '0'
        ]);


        //Update isCurrent to 0 in the Attendance for Regular Class if the Event is Going to Start
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

        //Also, Update isCurrent to 0 in the Regular Class if the Event is Going to Start
        Schedules::where('isMakeUp','0')->where('isCurrent', '1')->update([
            'isCurrent' => '0',
            'isAttend' => '0'
        ]);

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
                'isCurrent' => '0',
                'isAttend' => '0'
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

            //Update the Regular Schedule isCurrent = 1
            $scheds_start->update([
                'isCurrent' => '1'
            ]);
        }
    }

    //Update isCurrent = 0 if the Event is Ended
    $events_end->update([
        'isCurrent' => '0'
    ]);

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
        'isCurrent' => '0',
        'isAttend' => '0'
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
