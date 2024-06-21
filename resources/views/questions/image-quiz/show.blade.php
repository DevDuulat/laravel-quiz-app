@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Пазл Тренажер</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tests.index') }}"> Назад</a>
            </div>
        </div>
    </div>

    @if ($quizImages->isEmpty())
        <div class="alert alert-warning">
            {{ session('alert') }}
        </div>
    @else
        <div class="card">
            <div class="card-body">
                @foreach ($quizImages as $quizImage)
                    <div class="mb-4">
                        <h5 class="card-title">Вопрос: {{ $quizImage->question }}</h5>
                        <p class="card-text">Правильная последовательность: {{ implode(',', $quizImage->correct_sequence) }}</p>
                        <div class="row">
                            @foreach ($quizImage->images as $image)
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/' . $image) }}" class="img-fluid mb-2" alt="Изображение">
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('image-quiz.edit', ['test' => $test->id, 'imageQuiz' => $quizImage->id]) }}" class="btn btn-primary">Редактировать</a>
                        </div>

                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    @endif

@endsection
