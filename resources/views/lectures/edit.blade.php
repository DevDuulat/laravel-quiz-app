@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Edit Lecture
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('lectures.index') }}"> Back</a>
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

    <form action="{{ route('lectures.update', $lecture->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $lecture->title }}" class="form-control"
                           placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Text:</strong>
                    <textarea class="form-control" style="height:150px" name="text" placeholder="Text">{{ $lecture->text }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Publication Date:</strong>
                    <input type="date" name="publication_date" value="{{ $lecture->publication_date }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Cover Image URL:</strong>
                    <input type="text" name="image_url" value="{{ $lecture->image_url }}" class="form-control" placeholder="Cover Image URL">
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
