@php
  $type = strtolower(isset($type) ? $type : "text");
  $isTime = $type === "time";
  $isDate = $type === "date";
  if (in_array($type, ["date", "time"]))
    $type = "text";
@endphp
<div class="input-field{{ isset($class) ? (' ' . $class) : '' }}">
  <input
    id="{{ $name }}"
    name="{{ $name }}"
    type="{{ $type }}"
    @if (isset($readonly) && $readonly) readonly disabled @endif
    autocomplete="off"
    class="{{ $errors -> has($name) ? 'invalid' : '' }}{{ $isDate ? ' datepicker' : '' }}{{ $isTime ? ' timepicker' : '' }}"
    value="{{
      !empty($old)
        ? $old
        : (
          isset($dontFlash) && $dontFlash
            ? ""
            : old($name)
        )
    }}"
    @if (isset($attributes))
      @foreach ($attributes as $attribute => $attribute_value)
        {{ $attribute }}="{{ $attribute_value }}"
      @endforeach
    @endif
  >
  <label for="{{ $name }}">{{ empty($label) ? ucfirst($name) : $label }}</label>
  @if ($errors -> has($name))
    <span class="helper-text is-danger">{{ $errors -> first($name) }}</span>
  @endif
</div>