<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <div>
        <label for="content">Comment:</label>
        <textarea name="content" id="content" required>{{ old('content') }}</textarea>
        @error('content')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Add Comment</button>
</form>
