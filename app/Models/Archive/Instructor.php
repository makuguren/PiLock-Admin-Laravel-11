<?php

namespace App\Models\Archive;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Archive\Course;
use App\Models\Archive\Schedules;
use App\Models\Archive\Attendance;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'instructor';
    protected $connection = 'mysql_archive';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'instructor_theme',
        'tag_uid',
        'isDefaultPass'
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

    // public function schedules(){
    //     return $this->hasMany(Schedules::class, 'instructor_id', 'id');
    // }

    // public function course(){
    //     return $this->hasMany(Course::class, 'instructor_id', 'id');
    // }
}
