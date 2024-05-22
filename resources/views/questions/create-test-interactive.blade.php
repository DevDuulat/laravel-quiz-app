@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Создать Вопрос
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('tests.index') }}"> Назад</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('test-interactive.store', ['test' => $test->id]) }}" method="POST" id="question-form">

            @csrf
            <div id="question-blocks">
                <div class="question-block">
                    <div class="form-group">
                        <label for="question">Вопрос</label>
                        <input type="text" name="question_text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="answer">Правильный ответ</label>
                        <input type="text" name="correct_answer" class="form-control">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="addQuestionBlock()">Добавить Вопрос (+)</button>
            <button type="submit" class="btn btn-primary mt-3">Создать Вопрос</button>
        </form>


    </div>

    <script>
        function addQuestionBlock() {
            var questionBlock = document.querySelector('.question-block').cloneNode(true);
            document.getElementById('question-blocks').appendChild(questionBlock);
        }
    </script>
@endsection
