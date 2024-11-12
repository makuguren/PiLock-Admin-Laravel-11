<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Schedules;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'student_id',
        'course_id',
        'time_attend',
        'date',
        'time_end',
        'isPresent',
        'isCurrent',
        'isMakeUp'
    ];

    // Instructor Interface
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
