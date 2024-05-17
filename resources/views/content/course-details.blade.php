@extends('layouts.user')

@section('content')
    <!-- crumbs area start -->
    <div class="crumbs-area">
        <div class="container">
            <div class="crumb-content">
                <h4 class="crumb-title">{{ $lecture->title }}</h4>
            </div>
        </div>
    </div>
    <!-- crumbs area end -->

    <!-- course area start -->
    <div class="course-area ptb--100">
        <div class="container">
            <div class="row">
                <!-- course details start -->
                <div class="col-lg-12 col-md-12">
                    <div class="course-details">
                        <div class="cs-thumb mb-5">
                            <img src="{{ asset('storage/' . $lecture->image_url) }}" alt="{{ $lecture->image_url }}">


                            <!-- Добавьте код для отображения других данных лекции, таких как метаданные -->

                        </div>
                        <div class="cs-content">
                            <div class="col-12 d-sm-flex d-block">
{{--                                <p class="admin">Автор: {{ $lecture->author }}</p>--}}
                                <p>Дата публикации: {{ $lecture->publication_date }}</p>
                            </div>

                            <h3 class="mb-4">{{ $lecture->title }}</h3>
                            <p>{!! $lecture->text  !!} </p>

                            <div class="col-12">
                                <button type="button" class="btn btn-light btn_blog">Далее</button>
                                <button type="button" class="btn btn-light btn_blog">Назад</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-light btn_blog">На главную</a>
                            </div>

                            <!-- Добавьте код для отображения кнопок "Далее", "Назад" и ссылки на главную страницу -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- course area end -->
@endsection
