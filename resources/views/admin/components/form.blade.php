<form
    @if (isset($class)) class="{{ $class }}" @endif
    @if (isset($id)) id="{{ $id }}" @endif
    @if (isset($enctype)) enctype="{{ $enctype }}" @endif
    action="{{ $action }}"
    method="{{
        strtolower($method) === 'get'
            ? 'get'
            : 'post'
    }}"
>
    @unless (isset($noCsrf) && $noCsrf)
        @csrf
    @endif
    @if (in_array(strtolower($method), ["put", "delete"]))
        <input name="_method" type="hidden" value="{{ $method }}" />
    @endif
    {{ $slot }}
</form>