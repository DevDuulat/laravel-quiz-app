@extends('layouts.user')

@section('content')

    <!-- hero area start -->
    <div class="hero-area has-color ">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-10 col-12 offset-md-1">
                    <div class="hero-content">
                        <h1 class="mb-5"><span class="text-white">Криптографические методы защиты информации</span>
                        </h1>
                        <p class="text-white">Защита информации - деятельность по предотвращению утечки защищаемой
                            информации, несанкционированных и непреднамеренных воздействий на защищаемую информацию.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- take toure area start -->
    <div class="take-toure-area ptb--80 ">
        <div class="container">
            <div class="row">
                <div class="col-md-10  offset-md-1">
                    <div class="section-title-style3 white-title text-center">
                        <h3 class="text-white">Криптографические методы защиты информации</h3>
                        <h2 class="mb-5 mt-3">Обзор методов защиты информации </h2>
                    </div>
                </div>
            </div>
            <div class="video-area">
                <a class="expand-video" href="https://www.youtube.com/watch?v=fOhXN6gn0Q0"><i
                        class="fa fa-play"></i></a>
            </div>
        </div>
    </div>
    <!-- take toure area end -->

    <!-- blog area start -->
    <div class="feature-blog  ptb--10">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="section-title-style2 black-title  text-center">

                        <h2>Блог и новости</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="blog-carousel owl-carousel card-deck">
                    @foreach($blogs as $blog)
                        <div class="card mb-5">
                            <img class="card-img-top" src="{{ asset('storage/' . $blog->cover) }}" alt="image">
                            <div class="card-body p-25">
                                <ul class="list-inline primary-color mb-3">
                                    <li><i class="fa fa-clock-o"></i> {{ $blog->publication_date }}</li>
                                    <li><i class="fa fa-comments"></i> {{ $blog->comments_count }} комментариев</li>
                                </ul>
                                <h4 class="card-title mb-4"><a href="{{ route('blog.detail', $blog->id) }}">{{ $blog->title }}</a></h4>
                                <p class="card-text">{{ $blog->description }}</p>
                                <a class="btn btn-primary btn-round btn-sm" href="{{ route('blog.detail', ['id' => $blog->id]) }}">Читать далее</a>
                            </div>
                        </div><!-- card -->
                    @endforeach
                </div>
            </div>


        </div>
    </div>


@endsection
