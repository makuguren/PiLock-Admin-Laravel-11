<?php

namespace App\Models;

use App\Models\User;
use App\Models\Section;
use App\Models\Instructor;
use App\Models\EnrolledCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'course_code',
        'course_title',
        'section_id',
        'instructor_id',
        'course_key'
    ];

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function instructor(){
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function enrolledCourse(){
        return $this->hasMany(EnrolledCourse::class, 'course_id', 'id');
    }
}
