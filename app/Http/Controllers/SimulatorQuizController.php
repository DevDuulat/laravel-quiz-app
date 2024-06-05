<?php

namespace App\Http\Controllers;

use App\Models\SimulatorQuiz;
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
        return view('questions.simulator.create', compact('test'));
    }
    public function show(Test $test)
    {
        $simulator = \App\Models\SimulatorQuiz::where('test_id', $test->id)->get();

        if ($simulator->isEmpty()) {
            return back()->with('alert', 'Симулятор для этого теста не найден.');
        }

        return view('questions.simulator.show', compact('test','simulator'));
    }
    public function store(Request $request, $test_id)
    {
        $messages = [];
        $attributes = [];

        foreach ($request->questions as $index => $questionData) {
            $questionIndex = $index + 1;
            $attributes["questions.{$index}.question_text"] = "вопрос {$questionIndex}";
            $attributes["questions.{$index}.correct_answer"] = "правильный ответ {$questionIndex}";

            $messages["questions.{$index}.question_text.required"] = "Поле 'вопрос {$questionIndex}' обязательно для заполнения.";
            $messages["questions.{$index}.correct_answer.required"] = "Поле 'правильный ответ {$questionIndex}' обязательно для заполнения.";
        }

        $request->validate([
            'questions.*.question_text' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
        ], $messages, $attributes);

        $test = Test::findOrFail($test_id);

        foreach ($request->questions as $key => $questionData) {
            $question = new \App\Models\SimulatorQuiz([
                'question_text' => $questionData['question_text'],
                'correct_answer' => $questionData['correct_answer'],
            ]);

            $test->quizSimulator()->save($question);
        }

        return redirect()->route('tests.index')
            ->with('success', 'Вопросы созданы успешно.');
    }
    public function update(Request $request, Test $test, SimulatorQuiz $question)
    {
        $request->validate([
            'questions.0.question_text' => 'required|string',
            'questions.0.correct_answer' => 'required|string',
        ]);

        $question->update([
            'question_text' => $request->input('questions.0.question_text'),
            'correct_answer' => $request->input('questions.0.correct_answer'),
        ]);
        return redirect()->route('simulator-quiz.show', ['test' => $test->id])
            ->with('success', 'Вопросы созданы успешно.');
    }

    public function edit(Test $test, SimulatorQuiz $question)
    {
        return view('questions.simulator.edit', compact('test', 'question'));
    }

    public function destroy(Test $test, SimulatorQuiz $question)
    {
        $question->delete();

        return back()->with('success', 'Вопрос успешно удален.');
    }

}
