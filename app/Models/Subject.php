<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

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
