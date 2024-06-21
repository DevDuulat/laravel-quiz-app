<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'time_to_answer'
    ];

    public function interactiveSimulator()
    {
        return $this->hasMany(InteractiveSimulator::class);
    }
    public function quizSimulator()
    {
        return $this->hasMany(SimulatorQuiz::class);
    }
    public function imageQuiz()
    {
        return $this->hasMany(ImageQuiz::class);
    }
}
