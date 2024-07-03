<?php

namespace App\Models;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = [
        'student_id',
        'subject_id',
        'isPresent',
        'isCurrent'
    ];

    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
