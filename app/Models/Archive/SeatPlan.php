<?php

namespace App\Models\Archive;

use App\Models\Archive\User;
use App\Models\Archive\Schedules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeatPlan extends Model
{
    use HasFactory;

    protected $table = 'seat_plan';
    protected $connection = 'mysql_archive';
    protected $fillable = [
        'student_id',
        'course_id',
        'seat_number'
    ];

    // Instructor Interface
    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    // public function student(){
    //     return $this->belongsTo(User::class, 'student_id', 'id');
    // }

    // public function schedule(){
    //     return $this->belongsTo(Schedules::class, 'schedule_id', 'id');
    // }
}
