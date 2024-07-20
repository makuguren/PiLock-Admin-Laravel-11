<?php

namespace App\Models;

use App\Models\Log;
use App\Models\User;
use App\Models\Schedules;
use App\Models\Attendance;
use App\Models\ScheduleNow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $fillable = [
        'section_name'
    ];

    public function schedules(){
        return $this->hasMany(Schedules::class, 'section_id', 'id');
    }

    public function scheduleNow(){
        return $this->hasMany(ScheduleNow::class, 'section_id', 'id');
    }

    public function users(){
        return $this->hasMany(User::class, 'section_id', 'id');
    }

    public function logs(){
        return $this->hasMany(Log::class, 'section_id', 'id');
    }
}
