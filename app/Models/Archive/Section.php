<?php

namespace App\Models\Archive;

use App\Models\Archive\Log;
use App\Models\Archive\User;
use App\Models\Archive\Course;
use App\Models\Archive\Schedules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
    protected $connection = 'mysql_archive';
    protected $fillable = [
        'program',
        'year',
        'block'
    ];


    // Instructor Interface
    public function course(){
        return $this->hasMany(Course::class, 'section_id', 'id');
    }

    // public function schedules(){
    //     return $this->hasMany(Schedules::class, 'section_id', 'id');
    // }

    // public function course(){
    //     return $this->hasMany(Course::class, 'section_id', 'id');
    // }

    // public function users(){
    //     return $this->hasMany(User::class, 'section_id', 'id');
    // }

    // public function logs(){
    //     return $this->hasMany(Log::class, 'section_id', 'id');
    // }
}
