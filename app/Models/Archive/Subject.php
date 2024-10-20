<?php

namespace App\Models\Archive;

use App\Models\Archive\Log;
use App\Models\Archive\Schedules;
use App\Models\Archive\ScheduleNow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'subject_code',
        'subject_name'
    ];

    // public function schedules(){
    //     return $this->hasMany(Schedules::class, 'subject_id', 'id');
    // }

    // public function scheduleNow(){
    //     return $this->hasMany(ScheduleNow::class, 'subject_id', 'id');
    // }

    // public function logs(){
    //     return $this->hasMany(Log::class, 'subject_id', 'id');
    // }
}
