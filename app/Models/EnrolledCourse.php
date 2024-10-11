<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnrolledCourse extends Model
{
    use HasFactory;
    protected $table = 'enrolledcourses';
    protected $fillable = [
        'course_id',
        'student_id'
    ];

    // Instructor Interface
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
