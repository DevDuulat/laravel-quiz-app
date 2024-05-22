<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestInteractive extends Model
{
    use HasFactory;

    protected $table = 'new_test';
    protected $fillable = [
        'test_id', 'question_text', 'correct_answer'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
