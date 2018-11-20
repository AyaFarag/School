<label>
  <input
    type="checkbox"
    class="filled-in{{ isset($class) ? ' ' . $class : '' }}"
    name="{{ $name }}"
    value="{{ $value }}"
    @if (isset($checked) && $checked)
      checked="checked"
    @endif
    @if (isset($attributes))
      @foreach ($attributes as $attribute => $attribute_value)
        {{ $attribute }}="{{ $attribute_value }}"
      @endforeach
    @endif
  />
  <span>{{ $label }}</span>
</label>