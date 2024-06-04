<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'publication_date', 'image_url'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'lecture_access', 'lecture_id', 'user_id');
    }

    public function isReadByUser($userId)
    {
        return $this->lectureAccess()->where('user_id', $userId)->exists();
    }

    public function lectureAccess()
    {
        return $this->hasMany(LectureAccess::class);
    }
}
