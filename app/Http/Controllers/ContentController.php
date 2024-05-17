<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Test;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lectures = Lecture::all();
        $tests = Test::all();

        return view('content.index', compact('lectures', 'tests'));
    }

    public function showLecture($id)
    {
        $lecture = Lecture::findOrFail($id);
        return view('content.course-details', compact('lecture'));
    }

    public function testing($id)
    {
        $test = Test::findOrFail($id);
        $questions = $test->questions; // Получаем все вопросы для данного теста
        return view('content.test', compact('test', 'questions'));
    }
}
