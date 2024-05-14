@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Тесты
                    <div class="float-end">
                        @can('lecture-create')
                            <a class="btn btn-success" href="{{ route('tests.create') }}"> Создать новый тест</a>
                        @endcan
                    </div>
                </h2>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th width="430px">Действия</th>
        </tr>
        @foreach ($tests as $test)
            <tr>
                <td>{{ $test->name }}</td>
                <td>{{ $test->description }}</td>
                <td>
                    <form action="{{ route('tests.destroy',$test->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('questions.create',$test->id) }}">Создать вопросы</a>
                        <a class="btn btn-info" href="{{ route('tests.show',$test->id) }}">Просмотр</a>
                        @can('test-edit')
                            <a class="btn btn-primary" href="{{ route('tests.edit',$test->id) }}">Редактировать</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('test-delete')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
