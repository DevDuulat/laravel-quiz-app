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
        <form action="{{ route('image-quiz.store', ['test' => $test->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="question-container">
                <div class="question-item">
                    <div class="form-group">
                        <label for="question">Вопрос</label>
                        <input type="text" name="questions[0][question]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="images">Изображения</label>
                        <div class="image-upload-container">
                            <div class="input-group mb-3">
                                <input type="file" name="questions[0][images][]" class="form-control" required>
                                <button type="button" class="btn btn-danger btn-remove-image">Удалить</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary add-image-btn">Добавить изображение</button>
                        <div class="image-preview mt-3"></div>
                    </div>
                    <div class="form-group">
                        <label for="correct_sequence">Правильная последовательность (массив)</label>
                        <input type="text" name="questions[0][correct_sequence]" class="form-control correct-sequence" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-remove-question mt-5">Удалить вопрос</button>
                    <hr>
                </div>
            </div>
            <button type="button" id="add-question-btn" class="btn btn-primary">Добавить вопрос</button>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionContainer = document.getElementById('question-container');
            const addQuestionBtn = document.getElementById('add-question-btn');

            addQuestionBtn.addEventListener('click', addQuestion);

            questionContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-remove-question')) {
                    removeQuestion(e);
                } else if (e.target.classList.contains('add-image-btn')) {
                    addImageInput(e);
                } else if (e.target.classList.contains('btn-remove-image')) {
                    removeImageInput(e);
                }
            });

            questionContainer.addEventListener('change', function(e) {
                if (e.target.type === 'file') {
                    previewImage(e);
                }
            });

            function addQuestion() {
                const index = document.querySelectorAll('.question-item').length;
                const div = document.createElement('div');
                div.className = 'question-item';
                div.innerHTML = `
                <div class="form-group">
                    <label for="question">Вопрос</label>
                    <input type="text" name="questions[${index}][question]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="images">Изображения</label>
                    <div class="image-upload-container">
                        <div class="input-group mb-3">
                            <input type="file" name="questions[${index}][images][]" class="form-control" required>
                            <button type="button" class="btn btn-danger btn-remove-image">Удалить</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary add-image-btn">Добавить изображение</button>
                    <div class="image-preview mt-3"></div>
                </div>
                <div class="form-group">
                    <label for="correct_sequence">Правильная последовательность (массив)</label>
                    <input type="text" name="questions[${index}][correct_sequence]" class="form-control correct-sequence" required>
                </div>
                <button type="button" class="btn btn-danger btn-remove-question mt-5">Удалить вопрос</button>
                <hr>
            `;
                questionContainer.appendChild(div);
                toggleRemoveImageButtons(div);
            }

            function removeQuestion(e) {
                e.target.closest('.question-item').remove();
                updateCorrectSequenceInput();
            }

            function addImageInput(e) {
                const container = e.target.previousElementSibling;
                const inputGroup = document.createElement('div');
                inputGroup.className = 'input-group mb-3';
                inputGroup.innerHTML = `
                <input type="file" name="${e.target.previousElementSibling.querySelector('input[type=file]').name}" class="form-control" required>
                <button type="button" class="btn btn-danger btn-remove-image">Удалить</button>
            `;
                container.appendChild(inputGroup);
                toggleRemoveImageButtons(container.closest('.question-item'));
            }

            function removeImageInput(e) {
                const inputGroup = e.target.closest('.input-group');
                const questionItem = e.target.closest('.question-item');
                const inputIndex = Array.from(inputGroup.parentNode.children).indexOf(inputGroup);

                inputGroup.remove();
                updateCorrectSequenceInput();
                toggleRemoveImageButtons(questionItem);

                const preview = questionItem.querySelector('.image-preview');
                if (preview.children[inputIndex]) {
                    preview.children[inputIndex].remove();
                }
            }

            function previewImage(e) {
                const preview = e.target.closest('.form-group').querySelector('.image-preview');
                preview.innerHTML = '';
                Array.from(e.target.closest('.form-group').querySelectorAll('input[type="file"]')).forEach((input, index) => {
                    if (input.files.length > 0) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.style.maxWidth = '150px';
                            img.style.margin = '10px';
                            img.setAttribute('data-index', index);
                            preview.appendChild(img);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                });
                updateCorrectSequenceInput();
            }

            function updateCorrectSequenceInput() {
                document.querySelectorAll('.question-item').forEach((item, questionIndex) => {
                    const images = item.querySelectorAll('input[type="file"]');
                    const correctSequence = [];
                    images.forEach((input, imageIndex) => {
                        if (input.files.length > 0) {
                            correctSequence.push(`${imageIndex + 1}`);
                        }
                    });
                    item.querySelector('.correct-sequence').value = correctSequence.join(',');
                });
            }

            function toggleRemoveImageButtons(questionItem) {
                const imageInputs = questionItem.querySelectorAll('.input-group');
                const removeButtons = questionItem.querySelectorAll('.btn-remove-image');
                removeButtons.forEach(button => {
                    if (imageInputs.length === 1) {
                        button.style.display = 'none';
                    } else {
                        button.style.display = 'block';
                    }
                });
            }

            document.querySelectorAll('.question-item').forEach(item => {
                toggleRemoveImageButtons(item);
            });
        });
    </script>
@endsection
