@extends('layouts.user')

@section('content')
    <style>
        .solution_card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .solution_card:hover {
            transform: translateY(-5px);
        }

        .solu_title {
            padding: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .solu_title h3 {
            margin: 0;
        }

        .solu_description {
            padding: 10px;
        }

        .btn_color {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease-in-out;
        }

        .btn_color:hover {
            background-color: #0056b3;
        }
    </style>
<!-- body overlay area start -->
<div class="body_overlay"></div>
<!-- body overlay area end -->

<div class="container">
    <div class="row ptb--180 box-card-lesson">
        <div class="col-12 ">
            <h3 class="pb-5">Лекционный материал</h3>
            @foreach($lectures as $lecture)
                <div class="col-12">
                    <div class="our_solution_category">
                        <div class="solution_cards_box">
                            <div class="solution_card" style="{{ $lecture->isReadByUser(Auth::id()) ? '' : 'background-color: #ffcccc;' }}">
                                <div class="solu_title">
                                    <h3>{{ $lecture->title }}</h3>
                                </div>
                                <div class="solu_description">
                                    @php
                                        $hasImage = strpos($lecture->text, '<img') !== false;
                                    @endphp
                                    @if (!$hasImage)
                                        {!! Str::limit(strip_tags($lecture->text), 100) !!}
                                    @endif

                                </div>
                                <a href="{{ route('lecture.details', ['lecture' => $lecture->id]) }}" class="btn_color">Читать</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>




{{--        <div class="col-12 col-lg-6">--}}
{{--            <h3 class="pb-5">Система тестирования</h3>--}}
{{--            @foreach($tests as $test)--}}
{{--                <div class="col-12">--}}
{{--                    <div class="our_solution_category">--}}
{{--                        <div class="solution_cards_box">--}}
{{--                            <div class="solution_card">--}}
{{--                                <div class="solu_title">--}}
{{--                                    <h3>{{ $test->name }}</h3>--}}
{{--                                </div>--}}
{{--                                <div class="solu_description">--}}
{{--                                    <p>{{ Str::limit($test->description, 150) }}</p>--}}
{{--                                    <a href="{{ route('test.details', ['test' => $test->id]) }}" class="btn_color">Читать</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

    </div>
</div>

@endsection
