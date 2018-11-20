<div class="flex justify-end">
  <button
    class="btn-flat waves-effect waves-dark rounded flex justify-center{{ isset($tooltip) ? ' tooltipped' : '' }}{{ isset($class) ? ' ' . $class : '' }}"
    type="submit"
    @if (isset($tooltip))
      data-position="{{ isset($tooltipPosition) ? $tooltipPosition : 'top' }}"
      data-tooltip="{{ $tooltip }}"
    @endif
  >
    <i class="material-icons right">{{ !empty($icon) ? $icon : "send" }}</i>
  </button>
</div>