<?php

namespace App\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $connection = 'mysql_archive';

    protected $fillable = [
        'website_title',
        'isMaintenance',
        'isDevInteg',
        'isRegStud',
        'isRegLoginStud',
        'isRegInst',
        'isRegAdmins'
    ];
}
