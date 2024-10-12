<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SeatPlan;
use App\Models\Attendance;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedules extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'course_id',
        'instructor_id',
        'section_id',
        'days',
        'time_start',
        'time_end',
        'lateDuration',
        'isCurrent',
        'isMakeUp',
        'isApproved',
        'isAttend'
    ];

    // Admin Interface
    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    // public function subject(){
    //     return $this->belongsTo(Subject::class, 'subject_id', 'id');
    // }

    // public function course(){
    //     return $this->belongsTo(Course::class, 'course_id', 'id');
    // }

    // public function instructor(){
    //     return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    // }

    // public function section(){
    //     return $this->belongsTo(Section::class, 'section_id', 'id');
    // }

    // public function attendances(){
    //     return $this->hasMany(Attendance::class);
    // }

    // public function seatplan(){
    //     return $this->hasMany(SeatPlan::class, 'schedule_id', 'id');
    // }

    // public function student(){
    //     return $this->belongsTo(User::class, 'student_id', 'id');
    // }

    // protected $casts = [
    //     'time_start' => 'datetime:H:i',
    //     'time_end' => 'datetime:H:i',
    // ];
}
