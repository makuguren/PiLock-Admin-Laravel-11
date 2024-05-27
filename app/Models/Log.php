<?php

namespace App\Models;

use App\Models\User;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $fillable = [
        'student_id',
        'section_id',
        'subject_id',
        'instructor_id',
        'time',
        'date'
    ];

    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function instructor(){
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
