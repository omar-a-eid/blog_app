<div>
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="text" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}">
    @error($name)
        <p>{{ $message }}</p>
    @enderror
</div>
