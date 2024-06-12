@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Редактировать Вопрос</h2>
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
        <form action="{{ route('test-interactive.update', ['test' => $test->id, 'question' => $question->id]) }}" method="POST" id="question-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="question">Вопрос</label>
                <input type="text" name="question" class="form-control" value="{{ $question->question }}">
            </div>
            <div class="form-group">
                <label for="answer">Ответ</label>
                <input type="text" name="answer" class="form-control" value="{{ $question->answer }}">
            </div>
            <div class="form-group">
                <label for="options">Варианты ответов</label>
                <div class="options-container" data-key="0">
                    @foreach ($question->options as $option)
                        <div class="option-block">
                            <input type="text" name="options[]" class="form-control mb-2" value="{{ $option }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" onclick="serializeOptions()">Сохранить изменения</button>
        </form>
    </div>

    <script>
        function serializeOptions() {
            const optionsContainer = document.querySelector('.options-container');
            if (optionsContainer) {
                const optionInputs = optionsContainer.querySelectorAll('input');
                const options = Array.from(optionInputs).map(input => input.value);
                const serializedOptions = JSON.stringify(options);
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'options';
                hiddenInput.value = serializedOptions;
                document.getElementById('question-form').appendChild(hiddenInput);
                optionInputs.forEach(input => input.remove());
            }
        }
    </script>
@endsection
