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
            <th width="50px">Название</th>
            <th>Описание</th>
            <th width="950px">Действия</th>
        </tr>
        @foreach ($tests as $test)
            <tr>
                <td>{{ $test->name }}</td>
                <td>{!! Str::limit($test->description, 250)  !!}</td>
                <td>
                    <form action="{{ route('tests.destroy', $test->id) }}" method="POST">
                        <a href="{{ route('test-interactive.create', $test->id) }}" class="btn btn-info">
                            <i class="bi bi-clipboard-plus"></i>
                            Создать интерактив
                        </a>
                        <a href="{{ route('test-interactive.show', $test->id) }}" class="btn btn-info">
                            <i class="bi bi-clipboard-check"></i>
                            Показать интерактив
                        </a>
                        <a href="{{ route('simulator-quiz.create', $test->id) }}" class="btn btn-info">
                            <i class="bi bi-clipboard-check"></i>
                            Создать викторину
                        </a>
                        <a href="{{ route('simulator-quiz.show', $test->id) }}" class="btn btn-info">
                            <i class="bi bi-controller"></i> <!-- Иконка интерактивного тренажера -->
                            Показать викторину
                        </a>

                        <a href="{{ route('tests.show', $test->id) }}" class="btn btn-info">
                            <i class="bi bi-eye"></i> <!-- Иконка просмотра -->
                        </a>
                        @can('test-edit')
                            <a href="{{ route('tests.edit', $test->id) }}" class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @endcan
                        @csrf
                        @method('DELETE')
                        @can('test-delete')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> <!-- Иконка удаления -->
                            </button>
                        @endcan
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center">
        {{ $tests->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
