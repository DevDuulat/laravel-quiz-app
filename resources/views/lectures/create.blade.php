@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Создать новую лекцию
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('lectures.index') }}"> Назад</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Упс!</strong> Возникли некоторые проблемы с вашими данными.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lectures.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Изображение обложки:</strong>
                    <input type="file" name="image_url" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Название:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Название">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Дата публикации:</strong>
                    <input type="date" name="publication_date" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Текст:</strong>
                    <textarea class="form-control" id="editor" name="text" placeholder="Текст"></textarea>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script src="{{ asset('js/ckeditor-init.js') }}"></script>
@endsection


