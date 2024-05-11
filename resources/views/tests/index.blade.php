@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Test
                    <div class="float-end">
                        @can('lecture-create')
                            <a class="btn btn-success" href="{{ route('tests.create') }}"> Create New Test</a>
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
            <th>Title</th>
            <th>Details</th>
            <th width="430px">Action</th>
        </tr>
        @foreach ($tests as $test)
            <tr>
                <td>{{ $test->name }}</td>
                <td>{{ $test->description }}</td>
                <td>
                    <form action="{{ route('tests.destroy',$test->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('questions.create',$test->id) }}">Create questions</a>
                        <a class="btn btn-info" href="{{ route('tests.show',$test->id) }}">Show</a>
                        @can('test-edit')
                            <a class="btn btn-primary" href="{{ route('tests.edit',$test->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('test-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
