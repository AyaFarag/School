<div class="tap-target {{ config("sidebar-menu")["colors"][(isset($color) ? $color : "primary") . "-name"] }}" data-target="{{ $target }}">
  <div class="tap-target-content">
    <h5>{{ $title }}</h5>
    <p>{!! $content !!}</p>
  </div>
</div>