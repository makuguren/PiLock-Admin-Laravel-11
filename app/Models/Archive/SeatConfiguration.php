<?php

namespace App\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatConfiguration extends Model
{
    use HasFactory;

    protected $table = 'seats_configuration';
    protected $connection = 'mysql_archive';
    public $timestamps = false;

    protected $fillable = [
        'seat_number',
        'row',
        'column',
    ];
}
