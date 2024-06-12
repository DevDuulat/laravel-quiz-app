@extends('layouts.master')

@section('content')
    <style>
        .question {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .question h3 {
            margin-top: 0;
        }
        .question p {
            margin-bottom: 10px;
        }
        .question img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 8px;
        }
        .question .btn-group {
            margin-top: 10px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Тренажёр викторина</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tests.index') }}"> Назад</a>
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
                    @if (!empty($question->image))
                        <img src="{{ asset('storage/' . $question->image) }}" alt="Image">
                    @endif
                    <div class="btn-group">
                        <a href="{{ route('test-interactive.edit', ['test' => $test->id, 'question' => $question->id]) }}" class="btn btn-primary">Редактировать</a>
                        <form action="{{ route('test-interactive.destroy', ['test' => $test->id, 'question' => $question->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
