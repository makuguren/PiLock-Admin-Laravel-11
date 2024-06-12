<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = [
        'student_id',
        'isPresent'
    ];

    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
