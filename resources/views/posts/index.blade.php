@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <ul class="list-group">
            @foreach ($posts as $post)
                <li class="list-group-item">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
