@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Show Lecture
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('lectures.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $lecture->title }}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Text:</strong>
                {{ $lecture->text }}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Publication Date:</strong>
                {{ $lecture->publication_date }}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Cover Image URL:</strong>
                {{ $lecture->image_url }}
            </div>
        </div>
    </div>
@endsection
