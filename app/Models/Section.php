<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $fillable = [
        'section_name'
    ];

    // public function schedules(){
    //     return $this->hasMany(Schedules::class, 'section_id', 'id');
    // }

    // public function scheduleNow(){
    //     return $this->hasMany(ScheduleNow::class, 'section_id', 'id');
    // }

    // public function students(){
    //     return $this->hasMany(Student::class, 'section_id', 'id');
    // }

    // public function logs(){
    //     return $this->hasMany(Log::class, 'section_id', 'id');
    // }
}
