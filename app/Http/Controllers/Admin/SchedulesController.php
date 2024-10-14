<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Schedules;
use Illuminate\Http\Request;
use App\Imports\CourseImport;
use App\Imports\ScheduleImport;
use App\Http\Controllers\Controller;
use App\Models\MakeupSchedule;
use Maatwebsite\Excel\Facades\Excel;

class SchedulesController extends Controller
{
    // public function importSchedule(Request $request){
    //     $request->validate([
    //         'file_path' => ['required', 'file'],
    //     ]);

    //     Excel::import(new CourseImport, $request->file('file_path'));
    //     Excel::import(new ScheduleImport, $request->file('file_path'));

    //     return redirect()->back();
    //     toastr()->success('Schedules Imported Successfully');
    // }

    //API Controllers/Functions

    //Regular Schedules
    public function showSchedulesAPI()
    {
        $schedules = Schedules::where('isMakeUp', '0')->get();
        if ($schedules->count() > 0) {
            return response()->json([
                'schedules' => $schedules->map(function ($schedule) {
                    return [
                        'id' => $schedule->id,
                        'course_title' => $schedule->course->course_title,
                        'instructor' => $schedule->course->instructor->first_name . ' ' . $schedule->course->instructor->last_name,
                        'section' => $schedule->course->section->program . ' ' . $schedule->course->section->year . $schedule->course->section->block,
                        'days' => $schedule->days,
                        'time_start' => $schedule->time_start,
                        'time_end' => $schedule->time_end,
                        'isAttend' => $schedule->isAttend,
                        'lateDuration' => $schedule->lateDuration,
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

    public function showScheduleAPI(int $schedule_id)
    {
        $schedules = Schedules::where('id', $schedule_id)->get();
        if ($schedules->count() > 0) {
            return response()->json([
                'schedule' => $schedules->map(function ($schedule) {
                    return [
                        'id' => $schedule->id,
                        'course_title' => $schedule->course->course_title,
                        'instructor' => $schedule->course->instructor->first_name . ' ' . $schedule->course->instructor->last_name,
                        'section' => $schedule->course->section->program . ' ' . $schedule->course->section->year . $schedule->course->section->block,
                        'days' => $schedule->days,
                        'time_start' => $schedule->time_start,
                        'time_end' => $schedule->time_end,
                        'isAttend' => $schedule->isAttend,
                        'lateDuration' => $schedule->lateDuration,
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
    public function showMakeUpSchedsAPI()
    {
        $schedules = Schedules::where('isMakeUp', '1')->get();
        if ($schedules->count() > 0) {
            return response()->json([
                'schedules' => $schedules->map(function ($schedule) {
                    return [
                        'id' => $schedule->id,
                        'course_title' => $schedule->course->course_title,
                        'instructor' => $schedule->course->instructor->first_name . ' ' . $schedule->course->instructor->last_name,
                        'section' => $schedule->course->section->program . ' ' . $schedule->course->section->year . $schedule->course->section->block,
                        'days' => $schedule->days,
                        'time_start' => $schedule->time_start,
                        'time_end' => $schedule->time_end,
                        'isAttend' => $schedule->isAttend,
                        'lateDuration' => $schedule->lateDuration,
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

    public function showCurrentSchedAPI()
    {
        $currentsched = Schedules::where('isCurrent', '1')->get();
        $currentevent = Event::where('isCurrent', '1')->get();
        $currentmakeup = MakeupSchedule::where('isCurrent', '1')->get();

        //Check if There's an Event is not Empty else Direct to Schedule
        if ($currentevent->isNotEmpty()) {
            if ($currentevent->count() > 0) {
                return response()->json([
                    'event' => $currentevent->map(function ($curevent) {
                        return [
                            'id' => $curevent->id,
                            'sched_type' => 'Event',
                            'title' => $curevent->title,
                            'description' => $curevent->description,
                            'date' => $curevent->date,
                            'event_start' => $curevent->event_start,
                            'event_end' => $curevent->event_end,
                        ];
                    })
                ], 200);
            }
        } elseif ($currentmakeup->isNotEmpty()) {
            if ($currentmakeup->count() > 0) {
                return response()->json([
                    'makeupsched' => $currentmakeup->map(function ($curmakeupsched) {
                        return [
                            'id' => $curmakeupsched->id,
                            'sched_type' => 'Make-Up Class Schedule',
                            'course_title' => $curmakeupsched->course->course_title,
                            'instructor' => $curmakeupsched->course->instructor->first_name . ' ' . $curmakeupsched->course->instructor->last_name,
                            'section' => $curmakeupsched->course->section->program . ' ' . $curmakeupsched->course->section->year . $curmakeupsched->course->section->block,
                            'days' => $curmakeupsched->days,
                            'time_start' => $curmakeupsched->time_start,
                            'time_end' => $curmakeupsched->time_end,
                            'isAttend' => $curmakeupsched->isAttend,
                            'lateDuration' => $curmakeupsched->lateDuration,
                        ];
                    })
                ], 200);
            }
        } elseif ($currentsched->isNotEmpty()) {
            if ($currentsched->count() > 0) {
                return response()->json([
                    'schedule' => $currentsched->map(function ($curschedule) {
                        return [
                            'id' => $curschedule->id,
                            'sched_type' => 'Regular Class Schedule',
                            'course_title' => $curschedule->course->course_title,
                            'instructor' => $curschedule->course->instructor->first_name . ' ' . $curschedule->course->instructor->last_name,
                            'section' => $curschedule->course->section->program . ' ' . $curschedule->course->section->year . $curschedule->course->section->block,
                            'days' => $curschedule->days,
                            'time_start' => $curschedule->time_start,
                            'time_end' => $curschedule->time_end,
                            'isAttend' => $curschedule->isAttend,
                            'lateDuration' => $curschedule->lateDuration,
                        ];
                    })
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'status_message' => 'No Current Schedules/Events Found'
            ], 404);
        }
    }
}
