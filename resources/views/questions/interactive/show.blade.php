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
                <h2>Тренажёр викторина
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('tests.index') }}"> Назад</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="questions">
            @foreach ($interactiveSimulator as $question)
                <div class="question">
                    <h3>{{ $question->question }}</h3>
                    <p>Ответ: {{ $question->answer }}</p>
                    @if (!empty($question->options))
                        <ul>
                            @foreach ($question->options as $option)
                                <li>{{ $option }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('test-interactive.edit', ['test' => $test->id, 'question' => $question->id]) }}" class="btn btn-primary">Редактировать</a>
                    <form action="{{ route('test-interactive.destroy', ['test' => $test->id, 'question' => $question->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
