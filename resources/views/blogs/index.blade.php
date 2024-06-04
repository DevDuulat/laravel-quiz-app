@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>Список блогов</h2>
                </div>
                <div class="float-end">
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Создать новый блог</a>
                </div>
            </div>
        </div>

        @if ($blogs->isEmpty())
            <p>Блоги не найдены.</p>
        @else
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Описание</th>
                    <th>Дата публикации</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{!! Str::limit($blog->description, 250)  !!}</td>
                        <td>{{ $blog->publication_date }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info">Просмотр</a>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary">Редактировать</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот блог?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $blogs->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
