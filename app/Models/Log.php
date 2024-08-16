<?php

namespace App\Models;

use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $fillable = [
        'student_id',
        'course_id',
        'time',
        'date'
    ];

    // Admin Interface
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
