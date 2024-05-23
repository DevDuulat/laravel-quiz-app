@extends('layouts.user')

@section('content')

    <!-- body overlay area start -->
    <div class="body_overlay"></div>
    <!-- body overlay area end -->
    <!-- crumbs area start -->
    <div class="crumbs-area">
        <div class="container">
            <div class="crumb-content">
                <h4 class="crumb-title">{{ $blog->title }}</h4>
            </div>
        </div>
    </div>
    <!-- crumbs area end -->
    <!-- course area start -->
    <div class="blog-details-area ptb--120">
        <div class="container">
            <div class="row">
                <!-- course details start -->
                <div class="col-lg-8 col-md-12">
                    <div class="course-details">
                        <div class="cs-thumb mb-5">
                            <!-- Если есть обложка блога, используйте ее -->
                            @if($blog->cover)
                                <img src="{{ asset('storage/' . $blog->cover) }}" alt="{{ $blog->title }}">
                            @else
                                <!-- Если обложки нет, используйте заглушку или уберите этот блок -->
                                <img src="../assets/images/blog/default-cover.jpg" alt="Default Cover">
                            @endif
                        </div>
                        <div class="cs-content">
                            <div class="col-12 d-sm-flex  d-block ">
                                <p class="admin">Автор: {{ $blog->user->name }}</p>
                                <p>Дата публикации: {{ $blog->publication_date }}</p>
                            </div>
                            <h3 class="mb-4"><a href="#">{{ $blog->title }}</a></h3>
                            <p>{{ $blog->description }}</p>
                            <!-- Ваш контент блога -->
                            <p>{!! $blog->content  !!}</p>
                            <!-- Добавьте кнопку "Читать далее" -->
                            <!-- Здесь может быть ваша кнопка, которая будет вести на другую страницу с полным текстом блога -->

                            <div class="col-12">
                                <button type="button" class="btn btn-light  btn_blog">Далее</button>
                                <button type="button" class="btn btn-light  btn_blog">Назад</button>
                                <a href="/" class="btn btn-light  btn_blog">На главную</a>
                            </div>

                        </div>
                    </div>
                    <!-- comments area end -->
                    <!-- Остальной контент блога -->
                </div>
                <!-- course details end -->

                <!-- sidebar start -->
                <div class="col-lg-4 col-md-4 d-none d-lg-block ">
                    <div class="sidebar">
                        <!-- widget course start -->
                        <div class="widget widget-course d-none d-sm-block">
                            <h4 class="widget-title">Другие статьи</h4>
                            <div class="course-list">
                                @foreach($randomBlogs as $randomBlog)
                                    <div class="w-cs-single">
                                        <!-- Возможно, у блога есть обложка, используйте ее -->
                                        @if($randomBlog->cover)
                                            <img src="{{ asset('storage/' . $randomBlog->cover) }}" alt="{{ $randomBlog->title }}">
                                        @else
                                            <!-- Если обложки нет, используйте заглушку или уберите этот блок -->
                                            <img src="../assets/images/course/default-cover.jpg" alt="Default Cover">
                                        @endif
                                        <div class="fix">
                                            <p><a href="#">{{ $randomBlog->title }}</a></p>
                                            <span><i class="fa fa-clock-o"></i> {{ $randomBlog->publication_date }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- widget course end -->
                    </div>
                </div>
                </div>
                <!-- sidebar end -->
            </div>
        </div>

    <!-- course area end -->

@endsection
