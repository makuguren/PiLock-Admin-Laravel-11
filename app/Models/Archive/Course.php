<?php

namespace App\Models\Archive;

use App\Models\Archive\User;
use App\Models\Archive\Section;
use App\Models\Archive\Schedules;
use App\Models\Archive\Attendance;
use App\Models\Archive\Faculty;
use App\Models\Archive\EnrolledCourse;
use App\Models\Archive\MakeupSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'course_code',
        'course_title',
        'section_id',
        'faculty_id',
        'course_key'
    ];

    // Admin Interface
    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    // Faculty Interface
    public function attendance(){ //Current Attendance View
        return $this->hasMany(Attendance::class, 'course_id', 'id');
    }

    public function enrolledCourse(){
        return $this->hasMany(EnrolledCourse::class, 'course_id', 'id');
    }

    public function seatplan(){
        return $this->hasMany(SeatPlan::class, 'course_id', 'id');
    }

    public function schedule(){
        return $this->hasMany(Schedules::class, 'course_id', 'id');
    }

    public function makeupSched(){
        return $this->hasMany(MakeupSchedule::class, 'course_id', 'id');
    }
}
