@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Comment</h1>
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
            <div class="form-group">
                <label for="content">Comment Content:</label>
                <x-textarea-field label="Content" name="content" :value="$comment->content ?? old('content')" />
                @error('content')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Comment</button>
            <a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
