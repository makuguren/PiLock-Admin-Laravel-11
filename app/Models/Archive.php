<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $table = 'archives';

    protected $fillable = [
        'snapshot_name',
        'snapshot_data',
        'semester',
        'academic_year',
        'status'
    ];
}
