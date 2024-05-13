@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Создать нового пользователя
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Назад</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Упс!</strong> Возникли некоторые проблемы с вашим вводом.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Имя">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Пароль:</strong>
                    <input type="password" name="password" class="form-control" placeholder="Пароль">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Подтвердите пароль:</strong>
                    <input type="password" name="confirm-password" class="form-control" placeholder="Подтвердите пароль">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Роль:</strong>
                    <select class="form-control multiple" multiple name="roles[]">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </form>

@endsection
