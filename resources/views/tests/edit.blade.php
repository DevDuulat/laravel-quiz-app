@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Edit Test
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('tests.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tests.update', $test->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="name" value="{{ $test->name }}" class="form-control"
                           placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Text">{{ $test->description }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="time_to_answer">Time to Answer (seconds)</label>
                <input type="number" name="time_to_answer" value="{{ $test->time_to_answer }}"  id="time_to_answer" class="form-control">
            </div>

            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
