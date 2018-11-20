@php
  $hasItems = ($items instanceof Illuminate\Database\Eloquent\Collection ? $items -> count() : count($items)) > 0;
@endphp
@if ($hasItems)
  @php
    $actions_count = 0;
    if (!(isset($noEdit) && $noEdit))
      $actions_count += 1;
    if (!(isset($noDelete) && $noDelete))
      $actions_count += 1;
    $actions_count += isset($actions) ? count($actions) : 0;
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
              @if (!(isset($noEdit) && $noEdit) && isset($baseRouteName) && isset($model) && Auth::guard("admin") -> user() -> can("update", $model))
                <a href="{{ route($baseRouteName . '.edit', $item -> id) }}">
                  @include("admin.components.rounded-button", [
                    "icon"    => "edit",
                    "tooltip" => "Edit"
                  ])
                </a>
              @endif
              @if (!(isset($noDelete) && $noDelete) && isset($baseRouteName) && isset($model) && Auth::guard("admin") -> user() -> can("delete", $model))
                @component("admin.components.form", [
                  "class"  => "delete-form",
                  "method" => "DELETE",
                  "action" => route($baseRouteName . ".destroy", $item -> id)
                ])
                  @include("admin.components.rounded-button", [
                    "icon"    => "delete",
                    "tooltip" => "Delete"
                  ])
                @endcomponent
              @endif
              @if (isset($actions))
                @foreach ($actions as $action)
                  @if (!(array_key_exists("visible", $action) && !$action["visible"]))
                    @if (array_key_exists("isForm", $action))
                      @component("admin.components.form", [
                        "method" => array_key_exists("method", $action) ? $action["method"] : "POST",
                        "action" => $action["route"]($item)
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