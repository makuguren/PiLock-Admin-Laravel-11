<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleNow extends Model
{
    use HasFactory;

    protected $table = 'schedule_now';

    protected $fillable = [
        'subject_id',
        'instructor_id',
        'section_id',
        'days',
        'time_start',
        'time_end',
        'isMakeUp'
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
}
