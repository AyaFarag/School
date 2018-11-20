@php
  $hasItems = ($items instanceof Illuminate\Database\Eloquent\Collection ? $items -> count() : count($items)) > 0;
@endphp
@if ($hasItems)
  @php
    $actions_count = 0;
    if (isset($actions)) {
      foreach ($actions as $action) {
        if (!(array_key_exists("visible", $action) && !$action["visible"]))
          $actions_count += 1; 
      }
    }
  @endphp
  <table>
    <thead>
      <tr>
          @if ($actions_count)
            <th></th>
          @endif
          @foreach($columns as $columnKey => $column)
            <th>{{ $column["label"] }}</th>
          @endforeach
      </tr>
    </thead>

    <tbody>
      @foreach ($items as $item)
        <tr>
          @if ($actions_count)
            <td class="action size-{{$actions_count}}">
              @if (isset($actions))
                @foreach ($actions as $action)
                  @if ((!array_key_exists("can", $action) || auth("admin") -> user() -> can($action["can"], isset($action["model"]) ? $action["model"] : $item)) && !(array_key_exists("visible", $action) && !$action["visible"]))
                    @if (array_key_exists("method", $action))
                      @component("admin.components.form", [
                        "action" => $action["route"]($item),
                        "method" => $action["method"],
                        "class"  => strtolower($action["method"]) === "delete" ? "delete-form" : "",
                      ])
                        @include("admin.components.rounded-button", [
                          "icon"    => $action["icon"],
                          "tooltip" => $action["tooltip"]
                        ])
                      @endcomponent
                    @else
                      <a href="{{ $action["route"]($item) }}">
                        @include("admin.components.rounded-button", [
                          "icon"    => $action["icon"],
                          "tooltip" => $action["tooltip"]
                        ])
                      </a>
                    @endif
                  @endif
                @endforeach
              @endif
            </td>
          @endif
          @foreach($columns as $columnKey => $column)
            @if (array_key_exists("transform", $column))
              <td>{!! $column["transform"]($item -> { $columnKey }, $item) !!}</td>
            @else
              <td>{{ $item -> { $columnKey } }}</td>
            @endif
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>
  @if (($items instanceof \Illuminate\Pagination\LengthAwarePaginator && $items -> total() > $items -> perPage()) || $items instanceof \Illuminate\Pagination\Paginator)
    <div class="text-centered vertical-padding tiny">
      {{ $items -> links() }}
    </div>
  @endif
@else
  <h4 class="text-centered text-danger vertical-padding big">{{ $notFound }}</h4>
@endif