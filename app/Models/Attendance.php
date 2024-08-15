<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Schedules;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'student_id',
        'course_id',
        'date',
        'time_end',
        'isPresent',
        'isCurrent'
    ];

    // Instructor Interface
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
