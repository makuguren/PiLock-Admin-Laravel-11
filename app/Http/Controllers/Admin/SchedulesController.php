<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Schedules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchedulesController extends Controller
{
    //API Controllers/Functions

    //Regular Schedules
    public function showSchedulesAPI(){
        $schedules = Schedules::where('isMakeUp', '0')->get();
        if($schedules->count() > 0){
            return response()->json([
                'schedules' => $schedules->map(function ($schedule) {
                    return [
                        'id' => $schedule->id,
                        'subject' => $schedule->subject->subject_name,
                        'instructor' => $schedule->instructor->name,
                        'section' => $schedule->section->section_name,
                        'days' => $schedule->days,
                        'time_start' => $schedule->time_start,
                        'time_end' => $schedule->time_end
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Schedules Found'
            ], 404);
        }
    }

    public function showScheduleAPI(int $schedule_id){
        $schedules = Schedules::where('id', $schedule_id)->get();
        if($schedules->count() > 0){
            return response()->json([
                'schedule' => $schedules->map(function ($schedule) {
                    return [
                        'id' => $schedule->id,
                        'subject' => $schedule->subject->subject_name,
                        'instructor' => $schedule->instructor->name,
                        'section' => $schedule->section->section_name,
                        'days' => $schedule->days,
                        'time_start' => $schedule->time_start,
                        'time_end' => $schedule->time_end
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Schedule Found'
            ], 404);
        }
    }

    //Make-Up Schedules
    public function showMakeUpSchedsAPI(){
        $schedules = Schedules::where('isMakeUp', '1')->get();
        if($schedules->count() > 0){
            return response()->json([
                'schedules' => $schedules->map(function ($schedule) {
                    return [
                        'id' => $schedule->id,
                        'subject' => $schedule->subject->subject_name,
                        'instructor' => $schedule->instructor->name,
                        'section' => $schedule->section->section_name,
                        'days' => $schedule->days,
                        'time_start' => $schedule->time_start,
                        'time_end' => $schedule->time_end
                    ];
                })
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Make-Up Schedules Found'
            ], 404);
        }
    }

    public function showCurrentSchedAPI(){
        $currentsched = Schedules::where('isCurrent', '1')->get();
        $currentevent = Event::where('isCurrent', '1')->get();

        //Check if There's an Event is not Empty else Direct to Schedule
        if($currentevent->isNotEmpty()){
            if($currentevent->count() > 0){
                return response()->json([
                    'event' => $currentevent->map(function ($curevent) {
                        return [
                            'id' => $curevent->id,
                            'sched_type' => 'Event',
                            'title' => $curevent->title,
                            'description' => $curevent->description,
                            'date' => $curevent->date,
                            'event_start' => $curevent->event_start,
                            'event_end' => $curevent->event_end
                        ];
                    })
                ], 201);
            }
        } else {
            if($currentsched->count() > 0){
                return response()->json([
                    'schedule' => $currentsched->map(function ($curschedule) {
                        return [
                            'id' => $curschedule->id,
                            'sched_type' => 'Regular Class/Make-Up Schedules',
                            'subject' => $curschedule->subject->subject_name,
                            'instructor' => $curschedule->instructor->name,
                            'section' => $curschedule->section->section_name,
                            'days' => $curschedule->days,
                            'time_start' => $curschedule->time_start,
                            'time_end' => $curschedule->time_end
                        ];
                    })
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'status_message' => 'No Current Schedules/Events Found'
                ], 404);
            }
        }
    }
}
