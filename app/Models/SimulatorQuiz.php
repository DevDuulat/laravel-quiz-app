<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulatorQuiz extends Model
{
    use HasFactory;
    protected $table = 'simulator_quizzes';

    protected $fillable = [
        'test_id', 'question_text', 'correct_answer'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
