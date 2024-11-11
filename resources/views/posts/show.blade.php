@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h1 class="my-4">{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>

        <h2>Comments:</h2>
        @foreach ($post->comments as $comment)
            <div class="card my-2">
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
            @csrf
            <textarea name="content" class="form-control" placeholder="Add a comment" required></textarea>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
        </form>
    </div>
@endsection
