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
        <form action="{{ route('test-interactive.store', ['test' => $test->id]) }}" method="POST" id="question-form" enctype="multipart/form-data">
            @csrf
            <div id="question-blocks">
                @if (old('questions'))
                    @foreach (old('questions') as $key => $question)
                        <div class="question-block">
                            <div class="form-group">
                                <label for="question">Вопрос</label>
                                <input type="text" name="questions[{{ $key }}][question]" class="form-control @error('questions.'.$key.'.question') is-invalid @enderror" value="{{ old('questions.'.$key.'.question') }}">
                                @error('questions.'.$key.'.question')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-xs-12 mb-3">
                                <div class="form-group">
                                    <strong>Изображение:</strong>
                                    <input type="file" name="questions[{{ $key }}][image]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="answer">Ответ</label>
                                <input type="text" name="answers[{{ $key }}][answer]" class="form-control @error('answers.'.$key.'.answer') is-invalid @enderror" value="{{ old('answers.'.$key.'.answer') }}">
                                @error('answers.'.$key.'.answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="options">Варианты ответов</label>
                                <div class="options-container" data-key="{{ $key }}">
                                    @php
                                        $options = old('options.'.$key.'.options');
                                        if (is_string($options)) {
                                            $options = json_decode($options, true);
                                        }
                                    @endphp
                                    @if(is_array($options))
                                        @foreach ($options as $option)
                                            <div class="option-block">
                                                <input type="text" name="options[{{ $key }}][options][]" class="form-control mb-2" value="{{ $option }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-secondary add-option mt-2" data-key="{{ $key }}">Добавить Вариант</button>
                                @error('options.'.$key.'.options')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if ($key > 0)
                                <button type="button" class="btn btn-danger remove-question mt-2">Удалить Вопрос (-)</button>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="question-block" id="initial-question-block">
                        <div class="form-group">
                            <label for="question">Вопрос</label>
                            <textarea type="textarea" name="questions[0][question]" class="form-control"></textarea>
                        </div>
                        <div class="col-xs-12 mb-3">
                            <div class="form-group">
                                <strong>Изображение:</strong>
                                <input type="file" name="questions[0][image]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="answer">Ответ</label>
                            <input type="text" name="answers[0][answer]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="options">Варианты ответов</label>
                            <div class="options-container" data-key="0">
                                <div class="option-block">
                                    <input type="text" name="options[0][options][]" class="form-control mb-2" value="Вариант 1">
                                </div>
                                <div class="option-block">
                                    <input type="text" name="options[0][options][]" class="form-control mb-2" value="Вариант 2">
                                </div>
                                <div class="option-block">
                                    <input type="text" name="options[0][options][]" class="form-control mb-2" value="Вариант 3">
                                </div>
                                <div class="option-block">
                                    <input type="text" name="options[0][options][]" class="form-control mb-2" value="Вариант 4">
                                </div>
                            </div>
                            {{--                            <button type="button" class="btn btn-secondary add-option mt-2" data-key="0">Добавить Вариант</button>--}}
                        </div>
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="addQuestionBlock()">Добавить Вопрос (+)</button>
            <button type="submit" class="btn btn-primary mt-3" onclick="serializeOptions()">Создать Вопросы</button>
        </form>
    </div>

    <script>
        let questionCount = {{ old('questions') ? count(old('questions')) : 1 }};

        function addOptionBlock(key) {
            const optionsContainer = document.querySelector(`.options-container[data-key='${key}']`);
            const optionBlock = document.createElement('div');
            optionBlock.className = 'option-block';
            optionBlock.innerHTML = `<input type="text" name="options[${key}][options][]" class="form-control mb-2">`;
            optionsContainer.appendChild(optionBlock);
        }

        function addQuestionBlock() {
            var questionBlock = document.querySelector('.question-block').cloneNode(true);
            questionBlock.removeAttribute('id'); // Remove id from the cloned block

            let questionInputs = questionBlock.querySelectorAll('input');
            questionInputs.forEach(function(input) {
                if (input.name.includes('options')) {
                    input.name = input.name.replace(/\[\d+\]/, '[' + questionCount + ']');
                    input.value = '';
                } else if (input.type === 'file') {
                    input.name = input.name.replace(/\[\d+\]/, '[' + questionCount + ']');
                    input.value = null;
                } else {
                    input.name = input.name.replace(/\[\d+\]/, '[' + questionCount + ']');
                    input.value = '';
                }
            });

            questionBlock.querySelector('.options-container').dataset.key = questionCount;
            questionBlock.querySelectorAll('.add-option').forEach(button => {
                button.dataset.key = questionCount;
                button.addEventListener('click', () => {
                    addOptionBlock(button.dataset.key);
                });
            });

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
            questionCount++;
        }

        function removeQuestionBlock(button) {
            var questionBlock = button.closest('.question-block');
            if (document.querySelectorAll('.question-block').length > 1) {
                questionBlock.remove();
            }
        }

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-question')) {
                removeQuestionBlock(e.target);
            }
        });

        function serializeOptions() {
            const questionBlocks = document.querySelectorAll('.question-block');
            questionBlocks.forEach((block, index) => {
                const optionsContainer = block.querySelector(`.options-container[data-key='${index}']`);
                if (optionsContainer) {
                    const optionInputs = optionsContainer.querySelectorAll('input');
                    const options = Array.from(optionInputs).map(input => input.value);
                    const serializedOptions = JSON.stringify(options);
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `options[${index}][options]`;
                    hiddenInput.value = serializedOptions;
                    block.appendChild(hiddenInput);
                    optionInputs.forEach(input => input.remove());
                }
            });
        }
    </script>
@endsection
