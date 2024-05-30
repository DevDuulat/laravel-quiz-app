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
        <form action="{{ route('questions.store', ['test' => $test->id]) }}" method="POST" id="question-form">
            @csrf
            <div id="question-blocks">
                <div class="question-block">
                    <div class="form-group">
                        <label for="question">Вопрос</label>
                        <input type="text" name="questions[][question]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="answer">Ответ</label>
                        <input type="text" name="answers[][answer]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="options">Варианты ответов (JSON)</label>
                        <input type="text" name="options[][options]" class="form-control" value='["Вариант 1", "Вариант 2", "Вариант 3", "Вариант 4"]' placeholder='["Вариант 1", "Вариант 2", "Вариант 3", "Вариант 4"]'>
                    </div>
                    <button type="button" class="btn btn-danger remove-question mt-2">Удалить Вопрос (-)</button>
                </div>
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="addQuestionBlock()">Добавить Вопрос (+)</button>
            <button type="submit" class="btn btn-primary mt-3">Создать Вопросы</button>
        </form>
    </div>

    <script>
        function addQuestionBlock() {
            var questionBlock = document.querySelector('.question-block').cloneNode(true);
            var removeButton = questionBlock.querySelector('.remove-question');
            if (!removeButton) {
                var button = document.createElement('button');
                button.type = 'button';
                button.className = 'btn btn-danger remove-question mt-2';
                button.textContent = 'Удалить Вопрос (-)';
                button.onclick = function() {
                    removeQuestionBlock(this);
                };
                questionBlock.appendChild(button);
            }
            document.getElementById('question-blocks').appendChild(questionBlock);
        }

        function removeQuestionBlock(button) {
            var questionBlock = button.closest('.question-block');
            if (document.querySelectorAll('.question-block').length > 1) {
                questionBlock.remove();
            } else {
                alert('Должен быть хотя бы один вопрос.');
            }
        }

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-question')) {
                removeQuestionBlock(e.target);
            }
        });
    </script>
@endsection
