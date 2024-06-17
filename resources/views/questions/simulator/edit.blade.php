@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Редактировать Вопрос
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('tests.index') }}"> Назад</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('simulator-quiz.update', ['test' => $test->id, 'question' => $question->id]) }}" method="POST" id="question-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="question-blocks">
                <div class="question-block">
                    <div class="form-group">
                        <label for="questions[0][question_text]">Вопрос</label>
                        <input type="text" name="questions[0][question_text]" class="form-control @error('questions.0.question_text') is-invalid @enderror" value="{{ old('questions.0.question_text', $question->question_text) }}">
                        @error('questions.0.question_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="questions[0][correct_answer]">Правильный ответ</label>
                        <input type="text" name="questions[0][correct_answer]" class="form-control @error('questions.0.correct_answer') is-invalid @enderror" value="{{ old('questions.0.correct_answer', $question->correct_answer) }}">
                        @error('questions.0.correct_answer')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="questions[0][image]">Изображение</label>
                        <input type="file" name="questions[0][image]" class="form-control @error('questions.0.image') is-invalid @enderror">
                        @error('questions.0.image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить Изменения</button>
        </form>
    </div>
@endsection
