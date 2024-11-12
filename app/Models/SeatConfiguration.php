<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatConfiguration extends Model
{
    use HasFactory;

    protected $table = 'seats_configuration';
    public $timestamps = false;

    protected $fillable = [
        'seat_number',
        'row',
        'column',
    ];
}
