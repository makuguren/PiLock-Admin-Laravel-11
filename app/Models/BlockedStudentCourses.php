<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockedStudentCourses extends Model
{
    use HasFactory;
    protected $table = 'blocked_student_courses';
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
