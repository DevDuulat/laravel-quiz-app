@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>{{ $blog->title }}</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('blogs.index') }}">Вернуться к списку</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 mb-3">
                <p><strong>Описание:</strong> {{ $blog->description }}</p>
            </div>
            <div class="col-xs-12 mb-3">
                <p><strong>Дата публикации:</strong> {{ $blog->publication_date }}</p>
            </div>
            @if ($blog->cover)
                <div class="col-xs-12 mb-3">
                    <img src="{{ asset('storage/' . $blog->cover) }}" alt="Обложка" class="img-fluid">
                </div>
            @endif

            <div class="col-xs-12 mb-3">
                <div><strong>Содержание:</strong></div>
                <div>{!! ($blog->content) !!}</div>
            </div>
        </div>

    </div>
@endsection
