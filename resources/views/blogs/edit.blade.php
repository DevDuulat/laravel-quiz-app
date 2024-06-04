@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>Редактировать блог</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('blogs.index') }}">Назад</a>
                </div>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Упс!</strong> Возникли проблемы с вашим вводом.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Заголовок:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Заголовок" value="{{ old('title', $blog->title) }}">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Описание:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Описание">{{ old('description', $blog->description) }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Дата публикации:</strong>
                        <input type="date" name="publication_date" class="form-control" value="{{ old('publication_date', $blog->publication_date) }}">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Изображение обложки:</strong>
                        <input type="file" name="cover" class="form-control">
                        @if ($blog->cover)
                            <img src="{{ asset('storage/' . $blog->cover) }}" alt="Cover Image" class="img-thumbnail mt-2" width="150">
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Содержание:</strong>
                        <textarea class="form-control" id="editor" name="content" placeholder="Содержание">{{ old('content', $blog->content) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Обновить блог</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script src="{{ asset('js/ckeditor-init.js') }}"></script>
@endsection
