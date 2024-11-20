<?php

namespace App\Models\Archive;

use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use App\Models\Archive\SeatPlan;
use App\Models\Archive\Attendance;
use App\Models\Archive\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedules extends Model
{
    use HasFactory;

    protected $table = 'schedules';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'course_id',
        'faculty_id',
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

    // public function faculty(){
    //     return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
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
