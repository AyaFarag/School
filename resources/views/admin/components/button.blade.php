<div class="flex {{ isset($position) ? $position : "justify-end" }}">
    <button
        class="btn waves-effect waves-light {{
                config("sidebar-menu")["colors"][(isset($color) ? $color : "primary") . "-name"]
            }}{{
                isset($class) ? " $class" : ""
            }}"
        @if(isset($notSubmit) && !$notSubmit)type="submit"@endif
    >
        {{ !empty($label) ? $label : "Submit" }}
        <i class="material-icons right">{{ !empty($icon) ? $icon : "send" }}</i>
  </button>
</div>