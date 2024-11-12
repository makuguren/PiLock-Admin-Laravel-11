<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatBackup extends Model
{
    use HasFactory;

    protected $table = 'seats_backup';

    protected $fillable = [
        'name',
        'filepath'
    ];
}
