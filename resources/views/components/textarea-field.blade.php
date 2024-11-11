<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}">{{ $value }}</textarea>
    @error($name)
        <p>{{ $message }}</p>
    @enderror
</div>
