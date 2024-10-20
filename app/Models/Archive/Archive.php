<?php

namespace App\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $table = 'archives';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'snapshot_name',
        'snapshot_data',
        'semester',
        'academic_year',
        'status'
    ];
}
