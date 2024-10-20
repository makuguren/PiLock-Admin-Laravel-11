<?php

namespace App\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeupSchedule extends Model
{
    use HasFactory;

    protected $table = 'makeup_schedules';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'course_id',
        'instructor_id',
        'section_id',
        'days',
        'time_start',
        'time_end',
        'lateDuration',
        'isCurrent',
        'isApproved',
        'isAttend'
    ];

    // Admin Interface
    public function course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
