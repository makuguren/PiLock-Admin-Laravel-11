<?php

namespace App\Models;

use App\Models\Log;
use App\Models\Schedules;
use App\Models\ScheduleNow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'subject_code',
        'subject_name'
    ];

    public function schedules(){
        return $this->hasMany(Schedules::class, 'subject_id', 'id');
    }

    public function scheduleNow(){
        return $this->hasMany(ScheduleNow::class, 'subject_id', 'id');
    }

    public function logs(){
        return $this->hasMany(Log::class, 'subject_id', 'id');
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'subject_id', 'id');
    }
}
