@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Create Question
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('tests.index') }}"> Back</a>
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
                        <label for="question">Question</label>
                        <input type="text" name="questions[][question]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <input type="text" name="answers[][answer]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="options">Options (JSON)</label>
                        <input type="text" name="options[][options]" class="form-control" placeholder='["Option 1", "Option 2", "Option 3", "Option 4"]'>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success mt-3" onclick="addQuestionBlock()">Add Question (+)</button>
            <button type="submit" class="btn btn-primary mt-3">Create Questions</button>
        </form>


    </div>

    <script>
        function addQuestionBlock() {
            var questionBlock = document.querySelector('.question-block').cloneNode(true);
            document.getElementById('question-blocks').appendChild(questionBlock);
        }
    </script>
@endsection
