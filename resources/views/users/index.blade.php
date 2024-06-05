@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Управление пользователями
                    <div class="float-end">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Создать нового пользователя</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success my-2">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Роли</th>
            <th width="480px">Действия</th>
        </tr>
        @foreach ($data as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $role)
                            <label class="badge badge-secondary text-dark">{{ $role }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Редактирование</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


    <div class="d-flex justify-content-center">
        {{ $data->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
