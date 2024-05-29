@extends('layouts.user')

@section('content')

    <div class="container">
        <h1 class="text-center">Тест"</h1>
        <p class="text-center">Данный тест направлен на проверку знаний, полученных на предыдущих страницах. Ваша задача - вписать ответ в окно</p>
        <p class="text-center">Удачи в прохождении теста!</p>

        @foreach($questions as $question)
            <div class="card mt-4">
                <div class="card-body">
                    <p class="card-text">{{ $question->question_text }}</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="edit{{ $question->id }}" placeholder="Ответ">
                        <button class="btn btn-primary" id="btn{{ $question->id }}" onclick="prom('{{ $question->id }}', '{{ $question->correct_answer }}')">Ответить</button>
                    </div>
                </div>
            </div>
        @endforeach

        <div id="resultBox" class="my-4">
            <button class="btn btn-success" onclick="GetResult()">Результат</button>
        </div>
    </div>

    <!-- Модальное окно для вывода результатов -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog"
         aria-labelledby="resultModalLabel" aria-hidden="true"
         style="padding-right: 14px;padding-top: 160px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Результаты теста</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="resultModalBody">
                    <!-- Сюда будут вставлены результаты -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
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
            let resultHtml = "<p>Количество верных ответов: " + prav + "</p><p>Ваша оценка: " + estimation + "</p>";
            document.getElementById("resultModalBody").innerHTML = resultHtml;
            $('#resultModal').modal('show'); // Показываем модальное окно с результатами
        }
    </script>
@endsection
