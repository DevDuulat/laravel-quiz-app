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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('simulator-quiz.store', ['test' => $test->id]) }}" method="POST" id="question-form">
            @csrf
            <div id="question-blocks">
                <div class="question-block">
                    <div class="form-group">
                        <label for="questions[0][question_text]">Вопрос</label>
                        <input type="text" name="questions[0][question_text]" class="form-control @error('questions.0.question_text') is-invalid @enderror" value="{{ old('questions.0.question_text') }}">
                        @error('questions.0.question_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="questions[0][correct_answer]">Правильный ответ</label>
                        <input type="text" name="questions[0][correct_answer]" class="form-control @error('questions.0.correct_answer') is-invalid @enderror" value="{{ old('questions.0.correct_answer') }}">
                        @error('questions.0.correct_answer')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="addQuestionBlock()">Добавить Вопрос (+)</button>
            <button type="submit" class="btn btn-primary mt-3">Создать Вопрос</button>
        </form>



        <script>
            let questionCount = 1;

            function addQuestionBlock() {
                const questionBlocks = document.getElementById('question-blocks');

                const newBlock = document.createElement('div');
                newBlock.classList.add('question-block');

                const questionFormGroup = document.createElement('div');
                questionFormGroup.classList.add('form-group');
                const questionLabel = document.createElement('label');
                questionLabel.textContent = 'Вопрос';
                const questionInput = document.createElement('input');
                questionInput.type = 'text';
                questionInput.name = `questions[${questionCount}][question_text]`;
                questionInput.classList.add('form-control');
                questionFormGroup.appendChild(questionLabel);
                questionFormGroup.appendChild(questionInput);

                const answerFormGroup = document.createElement('div');
                answerFormGroup.classList.add('form-group');
                const answerLabel = document.createElement('label');
                answerLabel.textContent = 'Правильный ответ';
                const answerInput = document.createElement('input');
                answerInput.type = 'text';
                answerInput.name = `questions[${questionCount}][correct_answer]`;
                answerInput.classList.add('form-control');
                answerFormGroup.appendChild(answerLabel);
                answerFormGroup.appendChild(answerInput);

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.classList.add('btn', 'btn-danger', 'remove-question', 'mt-2');
                removeButton.textContent = 'Удалить Вопрос (-)';
                removeButton.onclick = () => removeQuestionBlock(removeButton);

                newBlock.appendChild(questionFormGroup);
                newBlock.appendChild(answerFormGroup);
                newBlock.appendChild(removeButton);

                questionBlocks.appendChild(newBlock);

                questionCount++;
            }

            function removeQuestionBlock(button) {
                const questionBlocks = document.getElementById('question-blocks');
                if (questionBlocks.childElementCount > 1) {
                    button.parentElement.remove();
                }
            }
        </script>
    </div>
@endsection
