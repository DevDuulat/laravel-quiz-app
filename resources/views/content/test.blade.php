@extends('layouts.user')

@section('content')

    <div class="test_box">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="start_btn d-flex justify-content-center">
                                <button class="start_btn btn btn-primary">Пройти тест</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="info_box">
                    <div class="info-title"><span>Некоторые правила тестирования</span></div>
                    <div class="info-list">
                        <div class="info">1. На каждый вопрос у вас будет <span>{{$test->time_to_answer}}</span> секунд</div>
                        <div class="info">2. После того как вы выберете ответ, его нельзя будет отменить.</div>
                        <div class="info">3. Вы не сможете выбрать какой-либо вариант, когда время истечет.</div>
                        <div class="info">4. Вы не можете выйти из викторины во время игры.</div>
                        <div class="info">5. Вы получите баллы за правильные ответы.</div>
                    </div>
                    <div class="buttons">
                        <button class="quit">Выйти из теста</button>
                        <button class="restart">Начать</button>
                    </div>
                </div>

                <!-- Quiz Box -->
                <div class="quiz_box">
                    <header>
                        <div class="title">{{$test->name}}</div>
                        <div class="timer">
                            <div class="time_left_txt">Осталось времени</div>
                            <div class="timer_sec">{{$test->time_to_answer}}</div>
                        </div>
                        <div class="time_line"></div>
                    </header>
                    <section>
                        <div class="que_text"></div>
                        <div class="option_list"></div>
                    </section>
                    <footer class="footer">
                        <div class="total_que"></div>
                        <button class="next_btn">Далее</button>
                    </footer>
                </div>

                <!-- Result Box -->
                <div class="result_box">
                    <div class="icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="complete_text">Вы прошли тест</div>
                    <div class="score_text"></div>
                    <div class="buttons">
                        <button class="restart">Пройти заново</button>
                        <button class="quit">Выйти</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let questions = [
                @foreach($questions as $question)
            {
                numb: {{ $question->id }},
                question: '{{ $question->question }}',
                answer: '{{ $question->answer }}',
                image: '{{ $question->image ? asset('storage/' . $question->image) : '' }}',
                options: [
                    @foreach($question->options as $option)
                        '{{ $option }}',
                    @endforeach
                ],
            },
            @endforeach
        ];

        const start_btn = document.querySelector('.start_btn button');
        const info_box = document.querySelector('.info_box');
        const exit_btn = info_box.querySelector('.buttons .quit');
        const continue_btn = info_box.querySelector('.buttons .restart');
        const quiz_box = document.querySelector('.quiz_box');
        const result_box = document.querySelector('.result_box');
        const option_list = document.querySelector('.option_list');
        const time_line = document.querySelector('header .time_line');
        const timeText = document.querySelector('.timer .time_left_txt');
        const timeCount = document.querySelector('.timer .timer_sec');

        start_btn.onclick = () => {
            info_box.classList.add('activeInfo');
        }

        exit_btn.onclick = () => {
            info_box.classList.remove('activeInfo');
        }

        continue_btn.onclick = () => {
            info_box.classList.remove('activeInfo');
            quiz_box.classList.add('activeQuiz');
            showQuestions(0);
            queCounter(1);
            startTimer({{$test->time_to_answer}});
            startTimerLine(0);
        }

        let timeValue = {{$test->time_to_answer}};
        let que_count = 0;
        let que_numb = 1;
        let userScore = 0;
        let counter;
        let counterLine;
        let widthValue = 0;

        const restart_quiz = result_box.querySelector('.buttons .restart');
        const quit_quiz = result_box.querySelector('.buttons .quit');

        restart_quiz.onclick = () => {
            quiz_box.classList.add('activeQuiz');
            result_box.classList.remove('activeResult');
            timeValue = {{$test->time_to_answer}};
            que_count = 0;
            que_numb = 1;
            userScore = 0;
            widthValue = 0;
            showQuestions(que_count);
            queCounter(que_numb);
            clearInterval(counter);
            clearInterval(counterLine);
            startTimer(timeValue);
            startTimerLine(widthValue);
            timeText.textContent = 'Осталось времени';
            next_btn.classList.remove('show');
        }

        quit_quiz.onclick = () => {
            window.location.reload();
        }

        const next_btn = document.querySelector('footer .next_btn');
        const bottom_ques_counter = document.querySelector('footer .total_que');

        next_btn.onclick = () => {
            if (que_count < questions.length - 1) {
                que_count++;
                que_numb++;
                showQuestions(que_count);
                queCounter(que_numb);
                clearInterval(counter);
                clearInterval(counterLine);
                startTimer(timeValue);
                startTimerLine(widthValue);
                timeText.textContent = 'Осталось времени';
                next_btn.classList.remove('show');
            } else {
                clearInterval(counter);
                clearInterval(counterLine);
                showResult();
            }
        }

        function showQuestions(index) {
            const que_text = document.querySelector('.que_text');

            let img_tag = '';
            if (questions[index].image) {
                img_tag = '<div><img src="' + questions[index].image + '" alt="Question Image" class="question-image" style="max-width: 50%; height: auto;"/></div>';
            }

            let que_tag = '<span>' + questions[index].question + '</span>' + img_tag;
            let option_tag = '';
            for (let i = 0; i < questions[index].options.length; i++) {
                option_tag += '<div class="option"><span>' + questions[index].options[i] + '</span></div>';
            }

            que_text.innerHTML = que_tag;
            option_list.innerHTML = option_tag;

            const option = option_list.querySelectorAll('.option');
            for (let i = 0; i < option.length; i++) {
                option[i].setAttribute('onclick', 'optionSelected(this)');
            }
        }

        function optionSelected(answer) {
            clearInterval(counter);
            clearInterval(counterLine);
            let userAns = answer.textContent;
            let correctAns = questions[que_count].answer;

            if (userAns == correctAns) {
                userScore += 1;
            }

            for (let i = 0; i < option_list.children.length; i++) {
                option_list.children[i].classList.add('disabled');
            }

            next_btn.classList.add('show');
        }

        function showResult() {
            info_box.classList.remove('activeInfo');
            quiz_box.classList.remove('activeQuiz');
            result_box.classList.add('activeResult');

            const scoreText = result_box.querySelector('.score_text');
            let scoreTag = '<span>Вы набрали <p>' + userScore + '</p> из <p>' + questions.length + '</p> правильных ответов.</span>';
            scoreText.innerHTML = scoreTag;

            showCorrectAnswers();
        }

        function showCorrectAnswers() {
            const resultList = result_box.querySelector('.score_text');
            let resultContent = '<ul>';
            questions.forEach((question, index) => {
                resultContent += '<li>' + question.question + '<br>Правильный ответ: ' + question.answer + '</li>';
            });
            resultContent += '</ul>';
            resultList.innerHTML += resultContent;
        }

        function startTimer(time) {
            counter = setInterval(timer, 1000);
            function timer() {
                timeCount.textContent = time;
                if (time < 10) {
                    timeCount.textContent = '0' + time;
                }
                if (time <= 0) {
                    clearInterval(counter);
                    timeText.textContent = 'Время вышло';
                    const allOptions = option_list.children.length;
                    let correctAns = questions[que_count].answer;
                    for (let i = 0; i < allOptions; i++) {
                        if (option_list.children[i].textContent == correctAns) {
                            option_list.children[i].setAttribute('class', 'option correct');
                            option_list.children[i].insertAdjacentHTML('beforeend', '<i class="fas fa-check"></i>'); // Add tick icon
                            console.log('Время вышло: Автоматически выбран правильный ответ.');
                        }
                    }
                    for (let i = 0; i < allOptions; i++) {
                        option_list.children[i].classList.add('disabled');
                    }
                    next_btn.classList.add('show');
                }
                time--; // Decrement time
            }
        }

        function startTimerLine(time) {
            counterLine = setInterval(timer, 29);
            function timer() {
                time += 1;
                time_line.style.width = time + 'px';
                if (time > 549) {
                    clearInterval(counterLine);
                }
            }
        }

        function queCounter(index) {
            let totalQueCounTag = '<span><p>' + index + '</p> из <p>' + questions.length + '</p> Вопросы</span>';
            bottom_ques_counter.innerHTML = totalQueCounTag;
        }
    </script>
@endsection
