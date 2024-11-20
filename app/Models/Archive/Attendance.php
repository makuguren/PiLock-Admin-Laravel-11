<?php

namespace App\Models\Archive;

use App\Models\Archive\User;
use App\Models\Archive\Course;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use App\Models\Archive\Schedules;
use App\Models\Archive\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $connection = 'mysql_archive';

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

    // Faculty Interface
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
