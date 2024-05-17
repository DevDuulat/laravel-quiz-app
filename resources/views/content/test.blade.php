@extends('layouts.user')

@section('content')

    <div class="test_boxs">
        <div class="container pt--130">
            <div class="row  ">
                <!-- start Quiz button -->
                <div class="start_btn col-12 d-flex justify-content-center"><button class=" start_btn btn btn-primary ">Пройти
                        тест</button></div>

                <!-- Info Box -->
                <div class="info_box ">
                    <div class="info-title"><span>Некоторые правила тестирования</span></div>
                    <div class="info-list">
                        <div class="info">1. На каждый вопрос у вас будет <span>15 </span> секунд</div>
                        <div class="info">2. После того как вы выберете ответ, его нельзя будет отменить..</div>
                        <div class="info">3. Вы не сможете выбрать какой-либо вариант, когда время истечет..</div>
                        <div class="info">4. Вы не можете выйти из викторины во время игры..</div>
                        <div class="info">5. Вы получите баллы за правильные ответы.</div>
                    </div>
                    <div class="buttons">
                        <button class="quit">Выйти из теста</button>
                        <button class="restart">Начать</button>
                    </div>
                </div>

                <!-- Quiz Box -->
                <div class="quiz_box ">
                    <header>
                        <div class="title">{{$test->name}}</div>
                        <div class="timer">
                            <div class="time_left_txt">Осталось времени </div>
                            <div class="timer_sec">{{$test->time_to_answer}}</div>
                        </div>
                        <div class="time_line"></div>
                    </header>
                    <section>
                        <div class="que_text">

                        </div>
                        <div class="option_list">

                        </div>
                    </section>


                    <footer class="footer">
                        <div class="total_que">

                        </div>
                        <button class="next_btn">Далее</button>
                    </footer>
                </div>

                <!-- Result Box -->
                <div class="result_box">
                    <div class="icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="complete_text">Вы прошли тест </div>
                    <div class="score_text">

                    </div>
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
                options: [
                    @foreach($question->options as $option)
                        '{{ $option }}',
                    @endforeach
                ],
            },
        @endforeach
    ];
    //selecting all required elements
    const start_btn = document.querySelector('.start_btn button')
    const info_box = document.querySelector('.info_box')
    const exit_btn = info_box.querySelector('.buttons .quit')
    const continue_btn = info_box.querySelector('.buttons .restart')
    const quiz_box = document.querySelector('.quiz_box')
    const result_box = document.querySelector('.result_box')
    const option_list = document.querySelector('.option_list')
    const time_line = document.querySelector('header .time_line')
    const timeText = document.querySelector('.timer .time_left_txt')
    const timeCount = document.querySelector('.timer .timer_sec')

    // if startQuiz button clicked
    start_btn.onclick = () => {
        info_box.classList.add('activeInfo') //show info box
    }

    // if exitQuiz button clicked
    exit_btn.onclick = () => {
        info_box.classList.remove('activeInfo') //hide info box
    }

    // if continueQuiz button clicked
    continue_btn.onclick = () => {
        info_box.classList.remove('activeInfo') //hide info box
        quiz_box.classList.add('activeQuiz') //show quiz box
        showQuetions(0) //calling showQestions function
        queCounter(1) //passing 1 parameter to queCounter
        startTimer(15) //calling startTimer function
        startTimerLine(0) //calling startTimerLine function
    }

    let timeValue = {{$test->time_to_answer}};
    let que_count = 0
    let que_numb = 1
    let userScore = 0
    let counter
    let counterLine
    let widthValue = 0

    const restart_quiz = result_box.querySelector('.buttons .restart')
    const quit_quiz = result_box.querySelector('.buttons .quit')

    // if restartQuiz button clicked
    restart_quiz.onclick = () => {
        quiz_box.classList.add('activeQuiz') //show quiz box
        result_box.classList.remove('activeResult') //hide result box
        timeValue = 15
        que_count = 0
        que_numb = 1
        userScore = 0
        widthValue = 0
        showQuetions(que_count) //calling showQestions function
        queCounter(que_numb) //passing que_numb value to queCounter
        clearInterval(counter) //clear counter
        clearInterval(counterLine) //clear counterLine
        startTimer(timeValue) //calling startTimer function
        startTimerLine(widthValue) //calling startTimerLine function
        timeText.textContent = 'Осталось времени' //change the text of timeText to Time Left
        next_btn.classList.remove('show') //hide the next button
    }

    // if quitQuiz button clicked
    quit_quiz.onclick = () => {
        window.location.reload() //reload the current window
    }

    const next_btn = document.querySelector('footer .next_btn')
    const bottom_ques_counter = document.querySelector('footer .total_que')

    // if Next Que button clicked
    next_btn.onclick = () => {
        if (que_count < questions.length - 1) {
            //if question count is less than total question length
            que_count++ //increment the que_count value
            que_numb++ //increment the que_numb value
            showQuetions(que_count) //calling showQestions function
            queCounter(que_numb) //passing que_numb value to queCounter
            clearInterval(counter) //clear counter
            clearInterval(counterLine) //clear counterLine
            startTimer(timeValue) //calling startTimer function
            startTimerLine(widthValue) //calling startTimerLine function
            timeText.textContent = 'Осталось времени ' //change the timeText to Time Left
            next_btn.classList.remove('show') //hide the next button
        } else {
            clearInterval(counter) //clear counter
            clearInterval(counterLine) //clear counterLine
            showResult() //calling showResult function
        }
    }

    // getting questions and options from array
    function showQuetions(index) {
        const que_text = document.querySelector('.que_text')

        //creating a new span and div tag for question and option and passing the value using array index
        let que_tag =
            '<span>' +
            questions[index].numb +
            '. ' +
            questions[index].question +
            '</span>'
        let option_tag =
            '<div class="option"><span>' +
            questions[index].options[0] +
            '</span></div>' +
            '<div class="option"><span>' +
            questions[index].options[1] +
            '</span></div>' +
            '<div class="option"><span>' +
            questions[index].options[2] +
            '</span></div>' +
            '<div class="option"><span>' +
            questions[index].options[3] +
            '</span></div>'
        que_text.innerHTML = que_tag //adding new span tag inside que_tag
        option_list.innerHTML = option_tag //adding new div tag inside option_tag

        const option = option_list.querySelectorAll('.option')

        // set onclick attribute to all available options
        for (i = 0; i < option.length; i++) {
            option[i].setAttribute('onclick', 'optionSelected(this)')
        }
    }
    // creating the new div tags which for icons
    let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>'
    let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>'

    //if user clicked on option
    function optionSelected(answer) {
        clearInterval(counter) //clear counter
        clearInterval(counterLine) //clear counterLine
        let userAns = answer.textContent //getting user selected option
        let correcAns = questions[que_count].answer //getting correct answer from array
        const allOptions = option_list.children.length //getting all option items

        if (userAns == correcAns) {
            //if user selected option is equal to array's correct answer
            userScore += 1 //upgrading score value with 1
            answer.classList.add('correct') //adding green color to correct selected option
            answer.insertAdjacentHTML('beforeend', tickIconTag) //adding tick icon to correct selected option
            console.log('Correct Answer')
            console.log('Your correct answers = ' + userScore)
        } else {
            answer.classList.add('incorrect') //adding red color to correct selected option
            answer.insertAdjacentHTML('beforeend', crossIconTag) //adding cross icon to correct selected option
            console.log('Wrong Answer')

            for (i = 0; i < allOptions; i++) {
                if (option_list.children[i].textContent == correcAns) {
                    //if there is an option which is matched to an array answer
                    option_list.children[i].setAttribute('class', 'option correct') //adding green color to matched option
                    option_list.children[i].insertAdjacentHTML('beforeend', tickIconTag) //adding tick icon to matched option
                    console.log('Auto selected correct answer.')
                }
            }
        }
        for (i = 0; i < allOptions; i++) {
            option_list.children[i].classList.add('disabled') //once user select an option then disabled all options
        }
        next_btn.classList.add('show') //show the next button if user selected any option
    }

    function showResult() {
        info_box.classList.remove('activeInfo') //hide info box
        quiz_box.classList.remove('activeQuiz') //hide quiz box
        result_box.classList.add('activeResult') //show result box
        const scoreText = result_box.querySelector('.score_text')
        if (userScore > 3) {
            // if user scored more than 3
            //creating a new span tag and passing the user score number and total question number
            let scoreTag =
                '<span>and congrats! 🎉, You got <p>' +
                userScore +
                '</p> out of <p>' +
                questions.length +
                '</p></span>'
            scoreText.innerHTML = scoreTag //adding new span tag inside score_Text
        } else if (userScore > 1) {
            // if user scored more than 1
            let scoreTag =
                '<span>and nice 😎, You got <p>' +
                userScore +
                '</p> out of <p>' +
                questions.length +
                '</p></span>'
            scoreText.innerHTML = scoreTag
        } else {
            // if user scored less than 1
            let scoreTag =
                '<span>and sorry 😐, You got only <p>' +
                userScore +
                '</p> out of <p>' +
                questions.length +
                '</p></span>'
            scoreText.innerHTML = scoreTag
        }
    }

    function startTimer(time) {
        counter = setInterval(timer, 1000)
        function timer() {
            timeCount.textContent = time //changing the value of timeCount with time value
            time-- //decrement the time value
            if (time < 9) {
                //if timer is less than 9
                let addZero = timeCount.textContent
                timeCount.textContent = '0' + addZero //add a 0 before time value
            }
            if (time < 0) {
                //if timer is less than 0
                clearInterval(counter) //clear counter
                timeText.textContent = 'Time Off' //change the time text to time off
                const allOptions = option_list.children.length //getting all option items
                let correcAns = questions[que_count].answer //getting correct answer from array
                for (i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correcAns) {
                        //if there is an option which is matched to an array answer
                        option_list.children[i].setAttribute('class', 'option correct') //adding green color to matched option
                        option_list.children[i].insertAdjacentHTML('beforeend', tickIconTag) //adding tick icon to matched option
                        console.log('Time Off: Auto selected correct answer.')
                    }
                }
                for (i = 0; i < allOptions; i++) {
                    option_list.children[i].classList.add('disabled') //once user select an option then disabled all options
                }
                next_btn.classList.add('show') //show the next button if user selected any option
            }
        }
    }

    function startTimerLine(time) {
        counterLine = setInterval(timer, 29)
        function timer() {
            time += 1 //upgrading time value with 1
            time_line.style.width = time + 'px' //increasing width of time_line with px by time value
            if (time > 549) {
                //if time value is greater than 549
                clearInterval(counterLine) //clear counterLine
            }
        }
    }

    function queCounter(index) {
        let totalQueCounTag =
            '<span><p>' +
            index +
            '</p> из <p>' +
            questions.length +
            '</p> Вопросы</span>'
        bottom_ques_counter.innerHTML = totalQueCounTag
    }

</script>

@endsection


