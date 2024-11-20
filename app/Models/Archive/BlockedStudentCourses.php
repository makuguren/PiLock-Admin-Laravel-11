<?php

namespace App\Models\Archive;

use App\Models\Archive\User;
use App\Models\Archive\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockedStudentCourses extends Model
{
    use HasFactory;
    protected $table = 'blocked_student_courses';
    protected $connection = 'mysql_archive';
    protected $fillable = [
        'student_id',
        'course_id',
    ];

    // Faculty Interface
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
