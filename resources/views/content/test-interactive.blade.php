@extends('layouts.user')

@section('content')

    <div class="container">
        <h1 class="text-center">Тест"</h1>
        <p class="text-center">Данный тест направлен на проверку знаний, полученных на предыдущих страницах. Ваша задача - вписать ответ в окно</p>
        <p class="text-center">Удачи в прохождении теста!</p>

        @foreach($questions as $question)
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Вопрос {{ $question->id }}</h5>
                    <p class="card-text">{{ $question->question_text }}</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="edit{{ $question->id }}" placeholder="Ответ">
                        <button class="btn btn-primary" id="btn{{ $question->id }}" onclick="prom({{ $question->id }}, '{{ $question->correct_answer }}')">Ответить</button>
                    </div>
                </div>
            </div>
        @endforeach

        <div id="resultBox" class="my-4" >
            <button class="btn btn-success" onclick="GetResult()">Результат</button>
        </div>
    </div>

    <script>
        let prav = 0;

        function prom(questionId, correctAnswer) {
            if (document.getElementById("edit" + questionId).value.trim() === correctAnswer.trim()) {
                prav++;
            }
            document.getElementById("btn" + questionId).disabled = true;
            document.getElementById("edit" + questionId).disabled = true;
        }

        function GetResult() {
            let estimation = 0;
            switch (prav) {
                case 0:
                case 1:
                    estimation = 2;
                    break;
                case 2:
                    estimation = 3;
                    break;
                case 3:
                    estimation = 4;
                    break;
                case 4:
                case 5:
                    estimation = 5;
                    break;
            }
            document.getElementById("resultBox").innerHTML += "<br>Количество верных ответов: " + prav + " Ваша оценка: " + estimation;
        }
    </script>
@endsection
