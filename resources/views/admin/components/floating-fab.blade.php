  <a class="tooltipped floating-action btn-floating btn-large waves-effect waves-light {{ config("sidebar-menu")["colors"][(isset($color) ? $color : "secondary") . "-name"] }}" href="{{ $to }}" data-position="top" data-tooltip="{{ isset($tooltip) ? $tooltip : "Create" }}"
    @if (isset($attributes))
      @foreach ($attributes as $attribute => $attribute_value)
        {{ $attribute }}="{{ $attribute_value }}"
      @endforeach
    @endif
  >
    <i class="material-icons">{{ !empty($icon) ? $icon : "add" }}</i>
  </a>