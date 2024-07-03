<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedules extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'subject_id',
        'instructor_id',
        'section_id',
        'days',
        'time_start',
        'time_end',
        'isMakeUp',
        'isApproved'
    ];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function instructor(){
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'schedule_id', 'id');
    }
}
