@extends('layouts.master')

@section('content')
    <style>
        .question {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Тест
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('tests.index') }}"> Назад</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card mb-3">
            <div class="card-header">
                <h1 class="card-title">{{ $test->name }}</h1>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $test->description }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">Информация о тесте</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Количество вопросов для Интерактивный тренажер <span class="badge bg-primary">{{ $simulatorQuizCount }}</span></li>
                    <li class="list-group-item">Количество вопросов для Тренажер викторина <span class="badge bg-primary">{{ $interactiveSimulatorCount }}</span></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
