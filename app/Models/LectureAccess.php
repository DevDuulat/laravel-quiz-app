<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureAccess extends Model
{
    use HasFactory;

    protected $table = 'lecture_access';
    public $timestamps = false;

    protected $fillable = [
        'lecture_id',
        'user_id'
    ];
}
