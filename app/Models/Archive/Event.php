<?php

namespace App\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'title',
        'description',
        'date',
        'event_start',
        'event_end',
        'isCurrent'
    ];
}
