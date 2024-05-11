@extends('layouts.master')

@section('content')
    <style>
        .question {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }


    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Create Question
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('tests.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>{{ $test->name }}</h1>
        <p>{{ $test->description }}</p>

        <div class="questions">
            @foreach ($test->questions as $question)
                <div class="question">
                    <h3>{{ $question->question }}</h3>
                    <p>Answer: {{ $question->answer }}</p>
                    @if (!empty($question->options))
                        <ul>
                            @foreach ($question->options as $option)
                                <li>{{ $option }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
