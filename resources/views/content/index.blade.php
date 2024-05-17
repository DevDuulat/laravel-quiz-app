@extends('layouts.user')

@section('content')
<!-- body overlay area start -->
<div class="body_overlay"></div>
<!-- body overlay area end -->

<div class="container">
    <div class="row ptb--180 box-card-lesson">
        <div class=" col-12 col-lg-6 ">
            <h3 class="pb-5">Лекционный материал</h3>
            @foreach($lectures as $lecture)
                <div class="col-12">
                    <div class="our_solution_category">
                        <div class="solution_cards_box">
                            <div class="solution_card">
                                <div class="solu_title">
                                    <h3>{{ $lecture->title }}</h3>
                                </div>
                                <div class="solu_description">
                                    <p>{!! Str::limit($lecture->text, 150)  !!}</p>
                                    <a href="{{ route('lecture.details', ['lecture' => $lecture->id]) }}" class="btn_color">Читать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>



        <div class="col-12 col-lg-6">
            <h3 class="pb-5">Система тестирования</h3>
            @foreach($tests as $test)
                <div class="col-12">
                    <div class="our_solution_category">
                        <div class="solution_cards_box">
                            <div class="solution_card">
                                <div class="solu_title">
                                    <h3>{{ $test->name }}</h3>
                                </div>
                                <div class="solu_description">
                                    <p>{{ Str::limit($test->description, 150) }}</p>
                                    <a href="{{ route('test.details', ['test' => $test->id]) }}" class="btn_color">Читать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

@endsection
