@extends('layouts.user')

@section('content')
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- body overlay area start -->
    <div class="body_overlay"></div>
    <!-- body overlay area end -->

    <div class="container">
        <div class="row ptb--180 box-card-lesson">
            <div class="col-12">
                <h3 class="pb-5">Тренажер викторина</h3>
                <div class="wrapper__box">
                    @foreach($testsWithInteractiveQuestions as $test)
                        <div class="test__content-box">
                            <h5 class="test__content-box-title">{{ $test->name ?? 'Название теста' }}</h5>
                            <a href="{{ route('test.interactive-simulator', $test->id) }}" class="test__content-box-button">Пройти тренажёр</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 pt--100">
                <h3 class="pb-5">Интерактивный тренажер</h3>
                <div class="wrapper__box">
                    @foreach($testsWithQuizQuestions as $test)
                        <div class="test__content-box">
                            <h5 class="test__content-box-title">{{ $test->name ?? 'Название теста' }}</h5>
                            <a href="{{ route('test.simulator-quiz', $test->id) }}" class="test__content-box-button">Пройти тренажёр</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 pt--100">
                <h3 class="pb-5">Пазл Тренажер</h3>
                <div class="wrapper__box">
                    @foreach($testsWithPuzzleQuestions as $test)
                        <div class="test__content-box">
                            <h5 class="test__content-box-title">{{ $test->name ?? 'Название теста' }}</h5>
                            <a href="{{ route('test.image-quiz', $test->id) }}" class="test__content-box-button">Пройти тренажёр</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
