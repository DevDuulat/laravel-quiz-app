@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>Blog List</h2>
                </div>
                <div class="float-end">
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create New Blog</a>
                </div>
            </div>
        </div>

        @if ($blogs->isEmpty())
            <p>No blogs found.</p>
        @else
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Publication Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->description }}</td>
                        <td>{{ $blog->publication_date }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
