<?php

namespace App\Models\Archive;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Archive\Section;
use App\Models\Archive\SeatPlan;
use App\Models\Archive\Attendance;
use App\Models\Archive\EnrolledCourse;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'web';
    protected $connection = 'mysql_archive';

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
        'first_name',
        'last_name',
        'tag_uid',
        'gender',
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

    public function seatPlan(){
        return $this->hasOne(SeatPlan::class, 'student_id', 'id');
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
