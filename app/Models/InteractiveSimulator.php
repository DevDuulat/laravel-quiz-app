<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteractiveSimulator extends Model
{
    use HasFactory;
    protected $table = 'interactive_simulators';
    protected $fillable = [
        'question', 'answer', 'options', 'test_id'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
