<?php

namespace App\Models\Archive;

use App\Models\Archive\User;
use App\Models\Archive\Section;
use App\Models\Archive\Subject;
use App\Models\Archive\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $connection = 'mysql_archive';
    protected $fillable = [
        'student_id',
        'course_id',
        'time_in',
        'time_out',
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
