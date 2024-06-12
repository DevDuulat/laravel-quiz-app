<?php

namespace App\Http\Controllers;

use App\Models\InteractiveSimulator;
use App\Models\Test;
use Illuminate\Http\Request;

class InteractiveSimulatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function create(Test $test)
    {
        return view('questions.interactive.create', compact('test'));
    }
    public function edit(Test $test, InteractiveSimulator $question)
    {
        return view('questions.interactive.edit', compact('test', 'question'));
    }

    public function update(Request $request, Test $test, InteractiveSimulator $question)
    {
        $attributes = [];

        $attributes['question'] = $request->input('question');
        $attributes['answer'] = $request->input('answer');
        $attributes['options'] = json_decode($request->input('options'), true);

        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'options' => 'nullable|string',
        ], [
            'question.required' => 'Поле :attribute обязательно для заполнения.',
            'answer.required' => 'Поле :attribute обязательно для заполнения.',
        ], $attributes);

        $question->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'options' => json_decode($request->input('options'), true),
        ]);
        return redirect()->route('test-interactive.show', ['test' => $test->id])
            ->with('success', 'Вопросы созданы успешно.');

    }

    public function show(Test $test)
    {
        $interactiveSimulator = InteractiveSimulator::where('test_id', $test->id)->get();

        if ($interactiveSimulator->isEmpty()) {
            return back()->with('alert', 'Интерактивный тренажер для этого теста не найден.');
        }

        return view('questions.interactive.show', compact('test', 'interactiveSimulator'));
    }


    public function store(Request $request, $test_id)
    {
        $attributes = [];

        foreach ($request->questions as $index => $questionData) {
            $questionIndex = $index + 1;
            $attributes["questions.{$index}.question"] = "вопрос {$questionIndex}";
            $attributes["answers.{$index}.answer"] = "ответ {$questionIndex}";
            $attributes["questions.{$index}.image"] = "изображение для вопроса {$questionIndex}";
        }

        $request->validate([
            'questions.*.question' => 'required|string',
            'questions.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'answers.*.answer' => 'required|string',
            'options.*.options' => 'nullable|string',
        ], [
            'questions.*.question.required' => 'Поле :attribute обязательно для заполнения.',
            'answers.*.answer.required' => 'Поле :attribute обязательно для заполнения.',
            'questions.*.image.image' => 'Файл :attribute должен быть изображением.',
            'questions.*.image.mimes' => 'Изображение для :attribute должно быть одного из следующих типов: jpeg, png, jpg, gif, svg.',
            'questions.*.image.max' => 'Изображение для :attribute не должно превышать 2048 KB.',
        ], $attributes);

        $test = Test::findOrFail($test_id);

        foreach ($request->questions as $key => $questionData) {
            $options = json_decode($request->options[$key]['options'], true);

            $question = new InteractiveSimulator([
                'question' => $questionData['question'],
                'answer' => $request->answers[$key]['answer'],
                'options' => $options,
            ]);

            if ($request->hasFile("questions.{$key}.image")) {
                $imagePath = $request->file("questions.{$key}.image")->store('images', 'public');
                $question->image = $imagePath;
            }

            $test->interactiveSimulator()->save($question);
        }

        return redirect()->route('tests.index')->with('success', 'Вопрос успешно обновлен.');
    }


    public function destroy(Test $test, InteractiveSimulator $question)
    {
        $question->delete();

        return back()->with('success', 'Вопрос успешно удален.');
    }

}
