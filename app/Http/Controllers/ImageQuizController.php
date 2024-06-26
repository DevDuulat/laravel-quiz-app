<?php

namespace App\Http\Controllers;

use App\Models\ImageQuiz;
use App\Models\Test;
use Illuminate\Http\Request;

class ImageQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function create(Test $test)
    {
        return view('questions.image-quiz.create', compact('test'));
    }

    public function store(Request $request, $test_id)
    {
        $test = Test::findOrFail($test_id);

        $request->validate([
            'questions' => 'required|array',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.images' => 'required|array',
            'questions.*.images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'questions.*.correct_sequence' => 'required|string',
        ]);

        foreach ($request->questions as $questionData) {
            $imagePaths = [];
            foreach ($questionData['images'] as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }

            // Преобразуем строку правильной последовательности в массив
            $correctSequenceArray = explode(',', $questionData['correct_sequence']);

            $imageQuiz = new ImageQuiz([
                'test_id' => $test->id,
                'question' => $questionData['question'],
                'images' => $imagePaths,
                'correct_sequence' => $correctSequenceArray,
            ]);

            $imageQuiz->save();
        }

        return redirect()->route('tests.index')
            ->with('success', 'Вопросы успешно созданы.');
    }

    public function show(Test $test)
    {
        $quizImages = ImageQuiz::where('test_id', $test->id)->get();

        if ($quizImages->isEmpty()) {
            return back()->with('alert', 'тренажер для этого теста не найден.');
        }

        return view('questions.image-quiz.show', compact('test', 'quizImages'));
    }

    public function edit(Test $test, ImageQuiz $imageQuiz)
    {

        return view('questions.image-quiz.edit', compact('test', 'imageQuiz'));
    }

    public function update(Request $request, Test $test, ImageQuiz $imageQuiz)
    {
        $request->validate([
            'questions.*.question' => 'required|string|max:255',
            'questions.*.images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'questions.*.correct_sequence' => 'required|string',
        ]);

        $questionData = $request->input('questions')[0];

        $imageQuiz->question = $questionData['question'];

        if ($request->hasFile('questions.0.images')) {
            $imagePaths = [];
            foreach ($request->file('questions.0.images') as $image) {
                $path = $image->store('images', 'public');
                $imagePaths[] = $path;
            }
            $imageQuiz->images = $imagePaths;
        }

        $correctSequenceArray = explode(',', $questionData['correct_sequence']);
        $imageQuiz->correct_sequence = $correctSequenceArray;

        $imageQuiz->save();

        return redirect()->route('tests.index')
            ->with('success', 'Вопрос успешно обновлен.');
    }

    public function destroy(Test $test, ImageQuiz $imageQuiz)
    {
        $imageQuiz->delete();

        return redirect()->route('tests.show', $test->id)
            ->with('success', 'Вопрос успешно удален');
    }

}
