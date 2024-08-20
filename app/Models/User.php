<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Section;
use App\Models\Attendance;
use App\Models\EnrolledCourse;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'student_id',
        'tag_uid',
        'gender',
        'birthdate',
        'section_id',
        'user_theme'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function section(){
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }


    // public function attendance(){
    //     return $this->hasMany(Attendance::class, 'student_id', 'id');
    // }

    // public function seatplan(){
    //     return $this->hasMany(User::class, 'student_id', 'id');
    // }

    // public function enrolledCourse(){
    //     return $this->hasMany(EnrolledCourse::class, 'student_id', 'id');
    // }
}
