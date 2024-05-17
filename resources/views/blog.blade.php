@extends('layouts.user')

@section('content')
    <!-- offset search area start -->
    <div class="offset-search">
        <form action="#">
            <input type="text" name="search" placeholder="Search here...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- offset search area end -->
    <!-- body overlay area start -->
    <div class="body_overlay"></div>
    <!-- body overlay area end -->
    <!-- crumbs area start -->
    <div class="crumbs-area">
        <div class="container">
            <div class="crumb-content">
                <h4 class="crumb-title">Блок и Новости</h4>
            </div>
        </div>
    </div>
    <!-- crumbs area end -->
    <!-- blog area start -->
    <div class="blog-area pt--120 pb--70">
        <div class="container">
            <div class="row">
                @foreach($blogs as $blog)
                    <!-- blog single start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-5">
                            <img class="card-img-top" src="{{ asset('storage/' . $blog->cover) }}" alt="image">
                            <div class="card-body p-25">
                                <ul class="list-inline blog-meta mb-3">
                                    <li><i class="fa fa-clock-o"></i> {{ $blog->publication_date }}</li>
                                    <li><i class="fa fa-comments"></i> {{ $blog->comments_count }} Коментарии</li>
                                </ul>
                                <h4 class="card-title mb-4"><a href="{{ route('blog.detail', ['blog' => $blog->id]) }}">{{ $blog->title }}</a></h4>
                                <p class="card-text">{{ $blog->description }}</p>
                                <a class="btn btn-primary btn-round btn-sm" href="{{ route('blog.detail', ['blog' => $blog->id]) }}">Читать далее</a>
                            </div>
                        </div><!-- card -->
                    </div>
                    <!-- blog single end -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- blog area end -->

@endsection
