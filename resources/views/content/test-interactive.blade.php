@extends('layouts.user')

@section('content')

    <div class="container">
        <div class="content-info">
            <h1 class="text-center">Интерактивный тренажер</h1>
            <p class="text-center">Данный тест направлен на проверку знаний, полученных на предыдущих страницах. Ваша задача - вписать ответ в окно</p>
            <p class="text-center">1. Ответ может быть число, слово или группа слов</p>
            <p class="text-center">2. Ответ записывайте строчными буквами </p>
            <p class="text-center">3. Ответ нельзя поменять после того как нажали на кнопку </p>
            <p class="text-center">Удачи в прохождении теста!</p>

            @foreach($questions as $question)
                <div class="card mt-4">
                    <div class="card-body">
                        <p class="card-text">{{ $question->question_text }}</p>

                        @if (!empty($question->image))
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="img-fluid rounded" style="max-width: 300px;">
                            </div>
                        @endif

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="edit{{ $question->id }}" placeholder="Введите текст или число" required>
                            <button class="btn btn-primary" id="btn{{ $question->id }}" onclick="validateAndSubmit('{{ $question->id }}', '{{ $question->correct_answer }}')">Ответить</button>
                        </div>
                    </div>
                </div>
            @endforeach

            <div id="resultBox" class="my-4" style="display: none;">
                <!-- Сюда будут вставлены результаты -->
            </div>
        </div>
    </div>

    <style>
        .content-info {
            margin-top: 30px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        .card-text {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .input-group {
            max-width: 400px;
            margin: 0 auto;
        }

        .btn-primary {
            margin-left: 10px;
        }

        #resultBox {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
    </style>

    <script>
        function validateAndSubmit(id, correctAnswer) {
            const input = document.getElementById('edit' + id);
            if (input.value.trim() === '') {
                alert('Введите текст или число.');
            } else {
                prom(id, correctAnswer);
            }
        }

        let prav = 0;
        let wrongAnswers = [];
        let answeredQuestions = new Set();

        function prom(questionId, correctAnswer) {
            const input = document.getElementById("edit" + questionId);
            if (input.value.trim().toLowerCase() === correctAnswer.trim().toLowerCase()) {
                prav++;
            } else {
                wrongAnswers.push({
                    question: questionId,
                    userAnswer: input.value.trim(),
                    correctAnswer: correctAnswer.trim()
                });
            }
            document.getElementById("btn" + questionId).disabled = true;
            input.disabled = true;
            answeredQuestions.add(questionId);

            const totalQuestions = {{ count($questions) }};
            if (answeredQuestions.size === totalQuestions) {
                showResult();
            }
        }

        function showResult() {
            let estimation = 0;
            const totalQuestions = {{ count($questions) }};
            if (prav === totalQuestions) {
                estimation = 5;
            } else if (prav === totalQuestions - 1) {
                estimation = 4;
            } else if (prav >= totalQuestions - 2) {
                estimation = 3;
            } else {
                estimation = 2;
            }

            let resultHtml = "<p>Количество верных ответов: " + prav + "</p><p>Ваша оценка: " + estimation + "</p>";
            if (wrongAnswers.length > 0) {
                resultHtml += "<p>Неправильные ответы:</p><ul>";
                wrongAnswers.forEach(function(answer) {
                    resultHtml += "<li>Вопрос #" + answer.question + ": Вы ответили '" + answer.userAnswer + "', правильный ответ: '" + answer.correctAnswer + "'</li>";
                });
                resultHtml += "</ul>";
            }
            document.getElementById("resultBox").innerHTML = resultHtml;
            document.getElementById("resultBox").style.display = "block";
        }
    </script>

@endsection
