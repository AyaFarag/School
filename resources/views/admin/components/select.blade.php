<div class="input-field{{ isset($class) ? " $class" : "" }}">
    <select
        @if (isset($name)) name="{{ $name }}" @endif
        @if ($errors -> has($name)) class="invalid" @endif
    >
        <option value="" disabled selected>Choose your option</option>
        @foreach ($options as $option => $title)
            <option
                value="{{ $option }}"
                @if (isset($old) && $old == $option || (!(isset($dontFlash) && $dontFlash) && !empty(old($name)) && old($name) == $option))
                    selected
                @endif
            >{{ $title }}</option>
        @endforeach
    </select>
    <label>{{ $label }}</label>
    @if ($errors -> has($name))
        <span class="helper-text is-danger">{{ $errors -> first($name) }}</span>
    @endif
</div>