<?php

namespace App\Http\Controllers;

use App\Models\InteractiveSimulator;
use App\Models\Lecture;
use App\Models\SimulatorQuiz;
use App\Models\Test;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserLectures()
    {
        $lectures = Lecture::all();

        return view('content.lectures', compact('lectures'));
    }

    public function UserTests()
    {
        $tests = Test::all();

        $testsWithInteractiveQuestions = $tests->filter(function ($test) {
            return $test->interactiveSimulator()->exists();
        });

        $testsWithQuizQuestions = $tests->filter(function ($test) {
            return $test->quizSimulator()->exists();
        });

        return view('content.tests', compact('testsWithInteractiveQuestions', 'testsWithQuizQuestions'));
    }


    public function showLecture($id)
    {
        $lecture = Lecture::findOrFail($id);

        $previousLecture = Lecture::where('id', '<', $lecture->id)->orderBy('id', 'desc')->first();
        $nextLecture = Lecture::where('id', '>', $lecture->id)->orderBy('id', 'asc')->first();

        return view('content.course-details', compact('lecture', 'previousLecture', 'nextLecture'));
    }

    public function testing($id)
    {
        $test = Test::findOrFail($id);
        $questions = $test->questions;


        return view('content.test', compact('test', 'questions'));
    }
    public function SimulatorQuizShow($id)
    {
        $test = Test::findOrFail($id);
        $questions = $test->quizSimulator;
        return view('content.test-interactive', compact('test',  'questions'));
    }


    public function InteractiveSimulatorShow($id)
    {
        $test = Test::with('interactiveSimulator')->findOrFail($id);
        $questions = $test->interactiveSimulator;

        return view('content.test', compact('test', 'questions'));
    }


}
