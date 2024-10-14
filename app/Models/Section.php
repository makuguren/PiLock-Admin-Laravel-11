<?php

namespace App\Models;

use App\Models\Log;
use App\Models\User;
use App\Models\Course;
use App\Models\Schedules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';
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
