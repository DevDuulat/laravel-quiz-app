<?php

namespace App\Http\Controllers;

use App\Models\InteractiveSimulator;
use App\Models\Test;
use Illuminate\Http\Request;

class InteractiveSimulatorController extends Controller
{
    //
    public function create(Test $test)
    {
        return view('questions.create', compact('test'));
    }

    public function store(Request $request, $test_id)
    {
        $request->validate([
            'questions.*.question' => 'required|string',
            'answers.*.answer' => 'required|string',
            'options.*.options' => 'nullable|string',
        ]);

        $test = Test::findOrFail($test_id);

        foreach ($request->questions as $key => $questionData) {
            $options = json_decode($request->options[$key]['options'], true);

            $question = new InteractiveSimulator([
                'question' => $questionData['question'],
                'answer' => $request->answers[$key]['answer'],
                'options' => $options,
            ]);

            $test->interactiveSimulator()->save($question);
        }

        return redirect()->route('tests.show', ['test' => $test_id])
            ->with('success', 'Вопросы созданы успешно.');
    }
}
