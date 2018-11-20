<div class="input-field{{ isset($class) ? ' ' . $class : '' }}">
  @php
    $oldValue = (
      !empty($old)
        ? $old
        : (
          isset($dontFlash) && $dontFlash
            ? ""
            : old($name)
        )
    );
  @endphp
  <textarea
    id="{{ $name }}"
    name="{{ $name }}"
    type="{{ empty($type) ? 'text' : $type }}"
    autocomplete="off"
    class="materialize-textarea{{ isset($class) ? " $class" : '' }}{{ $errors -> has($name) ? ' invalid' : '' }}"
    value="{{ $oldValue }}"
    @if (isset($attributes))
      @foreach ($attributes as $attribute => $attribute_value)
        {{ $attribute }}="{{ $attribute_value }}"
      @endforeach
    @endif
  >{{ $oldValue }}</textarea>
  <label for="{{ $name }}">{{ empty($label) ? ucfirst($name) : $label }}</label>
  @if ($errors -> has($name))
    <span class="helper-text is-danger">{{ $errors -> first($name) }}</span>
  @endif
</div>