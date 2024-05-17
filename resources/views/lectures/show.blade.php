@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Просмотр лекции
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('lectures.index') }}"> Назад</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Название:</strong>
                {{ $lecture->title }}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Текст:</strong>
                {!! $lecture->text !!}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Дата публикации:</strong>
                {{ $lecture->publication_date }}
            </div>
        </div>
        @if ($lecture->image_url)
            <div class="col-xs-12 mb-3">
                <img src="{{ asset('storage/' . $lecture->image_url) }}" alt="Обложка" class="img-fluid">
            </div>
        @endif

    </div>
@endsection
