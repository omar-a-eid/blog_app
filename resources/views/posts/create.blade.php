@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ isset($post) ? 'Edit Post' : 'Create New Post' }}</h1>
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST">
            @csrf
            @if (isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <x-input-field label="Title" name="title" :value="$post->title ?? old('title')" />
            </div>
            <div class="form-group">
                <x-textarea-field label="Content" name="content" :value="$post->content ?? old('content')" />
            </div>
            <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
        </form>
    </div>
@endsection
