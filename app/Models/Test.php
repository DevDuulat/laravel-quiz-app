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

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function testInteractives()
    {
        return $this->hasMany(TestInteractive::class);
    }
}
