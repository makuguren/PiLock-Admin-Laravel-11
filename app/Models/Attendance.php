<?php

namespace App\Models;

use App\Models\User;
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
        'schedule_id',
        'isPresent',
        'isCurrent',
        'date'
    ];

    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function schedules(){
        return $this->belongsTo(Schedules::class, 'schedule_id', 'id');
    }
}
