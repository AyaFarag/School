<div class="switch">
    <label>
        @if (isset($offLabel))
            {{ $offLabel }}
        @endif
        @php
            $dontFlash = isset($dontFlash) ? $dontFlash : false;
        @endphp
        <input
            type="checkbox"
            name="{{ $name }}"
            value="true"
            @if ((!empty($old) && $old) || (!$dontFlash && old($name)))
                checked
            @endif
        >
        <span class="lever"></span>
        @if (isset($onLabel))
            {{ $onLabel }}
        @endif
    </label>
</div>