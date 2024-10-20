<?php

namespace App\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventNow extends Model
{
    use HasFactory;

    protected $table = 'event_now';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'title',
        'description',
        'date',
        'event_start',
        'event_end'
    ];
}
