<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyLog extends Model
{
    use HasFactory;

    protected $table = 'faculty_logs';
    protected $fillable = [
        'course_id',
        'time_in',
        'time_out',
        'date'
    ];

    // Admin Interface
    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
