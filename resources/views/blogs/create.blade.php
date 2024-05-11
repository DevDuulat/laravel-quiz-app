@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>Create New Blog</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('blogs.index') }}">Back</a>
                </div>
            </div>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{ old('title') }}">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Publication Date:</strong>
                        <input type="date" name="publication_date" class="form-control" value="{{ old('publication_date') }}">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Cover Image:</strong>
                        <input type="file" name="cover" class="form-control">
                    </div>
                </div>

                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Content:</strong>
                        <textarea class="form-control" style="height:150px" name="content" placeholder="Content">{{ old('content') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create Blog</button>
                </div>
            </div>
        </form>
    </div>
@endsection
