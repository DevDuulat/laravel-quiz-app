@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Лекции
                    <div class="float-end">
                        @can('lecture-create')
                            <a class="btn btn-success" href="{{ route('lectures.create') }}"> Создать новую лекцию</a>
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
            <th>Детали</th>
            <th width="380px">Действие</th>
        </tr>
        @foreach ($lectures as $lecture)
            <tr>
                <td>{{ $lecture->title }}</td>

                <td>{!! Str::limit($lecture->text, 250)  !!}</td>
                <td>
                    <form action="{{ route('lectures.destroy',$lecture->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('lectures.show',$lecture->id) }}">Просмотр</a>
                        @can('lecture-edit')
                            <a class="btn btn-primary" href="{{ route('lectures.edit',$lecture->id) }}">Редактировать</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('lecture-delete')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
