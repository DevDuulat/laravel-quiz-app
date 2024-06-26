<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageQuiz extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'images', 'correct_sequence', 'test_id'];

    protected $casts = [
        'images' => 'array',
        'correct_sequence' => 'array',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
