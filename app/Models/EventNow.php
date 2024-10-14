<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventNow extends Model
{
    use HasFactory;

    protected $table = 'event_now';

    protected $fillable = [
        'title',
        'description',
        'date',
        'event_start',
        'event_end'
    ];
}
