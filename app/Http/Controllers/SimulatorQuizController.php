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
        // Validate the incoming request data
        $request->validate([
            'questions.*.question_text' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
        ]);

        // Find the test by its ID
        $test = Test::findOrFail($test_id);

        // Iterate over each question in the request
        foreach ($request->questions as $key => $questionData) {
            // Create a new SimulatorQuiz instance with the question data
            $question = new \App\Models\SimulatorQuiz([
                'question_text' => $questionData['question_text'],
                'correct_answer' => $questionData['correct_answer'],
            ]);

            // Save the question to the test
            $test->quizSimulator()->save($question);
        }

        // Redirect to the test index with a success message
        return redirect()->route('tests.index')
            ->with('success', 'Вопросы созданы успешно.');
    }

}
