@extends('layouts.user')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .question {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            margin-bottom: 10px;
        }

        .image-wrapper {
            margin: 20px 5px;
            position: relative;
            cursor: grab;
        }

        .image-wrapper img {
            width: 300px;
            height: 300px;
            object-fit: fill;
        }

        .button-container {
            margin-bottom: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 700px;
            text-align: center;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .close {
            display: flex;
            justify-content: end;
            color: #000;
            float: right;
            font-size: 30px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .image-wrapper:hover .zoom-icon {
            display: block;
        }

        .zoom-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 50%;
            padding: 5px;
            display: none;
            cursor: pointer;
        }

        .full-screen-modal {
            display: none;
            position: fixed;
            z-index: 2;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            object-fit: fill;
        }

        .full-screen-modal img {
            width: 60%;
            height: 60%;
            object-fit: contain;
        }
    </style>

    <div class="container">
        <div class="row ptb--150 box-card-lesson">
            <div class="col-12">
                <div class="pb--50 text-center">
                    <h2>Тренажер картинки</h2>
                </div>
                <div id="questions-container">
                    <!-- Вопросы будут добавлены динамически -->
                </div>

                <!-- Кнопка завершить тренажер -->
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" id="finish-button" onclick="finishTest()">Завершить тренажер</button>
                </div>

                <!-- Модальное окно для результата -->
                <div id="resultModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <p id="resultText"></p>
                    </div>
                </div>

                <!-- Модальное окно для увеличенного изображения -->
                <div id="fullScreenModal" class="full-screen-modal" onclick="closeFullScreenModal()">
                    <img id="fullScreenImage" src="" alt="Full Screen Image">
                </div>
            </div>
        </div>
    </div>

    @php
        $questionsData = $questions->map(function($question) {
            return [
                'question' => $question->question,
                'sequence' => json_encode($question->correct_sequence),
                'images' => json_encode($question->images)
            ];
        });
    @endphp

    <script>
        const questionsData = @json($questionsData);

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function createQuestionElement(questionData) {
            const questionContainer = document.createElement('div');
            questionContainer.classList.add('question');

            const questionTitle = document.createElement('h3');
            questionTitle.textContent = questionData.question;
            questionContainer.appendChild(questionTitle);

            const imageContainer = document.createElement('div');
            imageContainer.classList.add('image-container');
            imageContainer.setAttribute('data-sequence', questionData.sequence); // Устанавливаем правильную последовательность

            const images = JSON.parse(questionData.images);
            const shuffledImages = shuffle([...images]);

            shuffledImages.forEach((src, index) => {
                const imageWrapper = document.createElement('div');
                imageWrapper.classList.add('image-wrapper');
                imageWrapper.setAttribute('draggable', true);
                imageWrapper.setAttribute('data-index', images.indexOf(src) + 1); // Сохранение исходного индекса изображения

                const img = document.createElement('img');
                img.src = `{{ asset('storage') }}/${src}`;
                img.onclick = () => openFullScreenModal(`{{ asset('storage') }}/${src}`);
                imageWrapper.appendChild(img);

                const zoomIcon = document.createElement('i');
                zoomIcon.classList.add('fas', 'fa-search-plus', 'zoom-icon');
                zoomIcon.onclick = () => openFullScreenModal(`{{ asset('storage') }}/${src}`);
                imageWrapper.appendChild(zoomIcon);

                imageContainer.appendChild(imageWrapper);
            });

            questionContainer.appendChild(imageContainer);
            document.getElementById('questions-container').appendChild(questionContainer);

            addDragAndDrop(imageContainer);
        }

        function addDragAndDrop(container) {
            let draggedItem = null;

            container.addEventListener('dragstart', function (event) {
                draggedItem = event.target.closest('.image-wrapper');
                event.dataTransfer.setData('text/html', draggedItem);
                event.target.closest('.image-wrapper').classList.add('dragging');
            });

            container.addEventListener('dragover', function (event) {
                event.preventDefault();
                const overItem = event.target.closest('.image-wrapper');

                if (overItem && overItem !== draggedItem) {
                    const rect = overItem.getBoundingClientRect();
                    const midX = rect.left + rect.width / 2;
                    const isRightHalf = event.clientX >= midX;

                    if (isRightHalf) {
                        container.insertBefore(draggedItem, overItem.nextSibling);
                    } else {
                        container.insertBefore(draggedItem, overItem);
                    }
                }
            });

            container.addEventListener('dragend', function (event) {
                draggedItem.classList.remove('dragging');
                draggedItem = null;
            });
        }

        function finishTest() {
            const questions = document.querySelectorAll('.question');
            let correctAnswers = 0;

            questions.forEach(question => {
                const imageContainer = question.querySelector('.image-container');
                const correctSequence = JSON.parse(imageContainer.getAttribute('data-sequence'));
                const userSequence = [];

                imageContainer.querySelectorAll('.image-wrapper').forEach(wrapper => {
                    userSequence.push(wrapper.getAttribute('data-index'));
                });

                if (arraysEqual(correctSequence, userSequence)) {
                    correctAnswers++;
                }
            });

            const totalQuestions = questions.length;
            const resultText = `Тест завершен! Правильных ответов: ${correctAnswers} из ${totalQuestions}`;

            showModal(resultText);
        }

        function arraysEqual(arr1, arr2) {
            if (arr1.length !== arr2.length) return false;
            for (let i = 0; i < arr1.length; i++) {
                if (arr1[i] !== arr2[i]) return false;
            }
            return true;
        }

        function showModal(text) {
            const modal = document.getElementById('resultModal');
            const resultText = document.getElementById('resultText');
            resultText.textContent = text;
            modal.style.display = 'block';
        }

        function closeModal() {
            const modal = document.getElementById('resultModal');
            modal.style.display = 'none';
        }

        function openFullScreenModal(filename) {
            const modal = document.getElementById('fullScreenModal');
            const fullScreenImage = document.getElementById('fullScreenImage');
            fullScreenImage.src = filename;
            modal.style.display = 'flex';
        }

        function closeFullScreenModal() {
            const modal = document.getElementById('fullScreenModal');
            modal.style.display = 'none';
        }

        questionsData.forEach(questionData => {
            createQuestionElement(questionData);
        });
    </script>
@endsection
