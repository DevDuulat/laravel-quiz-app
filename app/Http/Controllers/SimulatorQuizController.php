<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class SimulatorQuizController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function create(Test $test)
    {
        return view('questions.create-test-interactive', compact('test'));
    }
    public function store(Request $request, $test_id)
    {
        $request->validate([
            'question_text' => 'required|string',
            'correct_answer' => 'required|string',
        ]);
        $test = Test::findOrFail($test_id);
        $question = new \App\Models\SimulatorQuiz([
            'question_text' => $request->input('question_text'),
            'correct_answer' => $request->input('correct_answer'),
        ]);

        $test->quizSimulator()->save($question);

        return redirect()->route('tests.index')
            ->with('success', 'Вопросы созданы успешно.');
    }
}
