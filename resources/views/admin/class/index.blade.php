@extends("admin.layout.app")

@section("navbar")
  <h4>Classes</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "get",
          "action" => route("admin.class.index"),
          "noCsrf" => true
        ])
          <div class="row">
            <div class="col-xs-12">
              @include("admin.components.select", [
                "label"   => "Level",
                "name"    => "level",
                "options" => $levels,
                "old"     => request() -> input("level")
              ])
            </div>
          </div>
          <div class="flex justify-end margin-top">
            @include("admin.components.button", [
              "label" => "Reset",
              "icon" => "replay",
              "class" => "reset-filters margin-right",
              
            ])
            <div data-action="{{ route("admin.class.index") }}">
              @include("admin.components.button", [
                "icon"  => "filter_list",
                "label" => "filter",
                "color" => "secondary"
              ])
            </div>
          </div>
        @endcomponent
      </div>
    </div>
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.class",
          "notFound"      => "No classes were found!",
          "items"         => $classes,
          "model"         => \App\Models\ClassModel::class,
          "columns"       => [
            "name" => ["label" => "Name"],
            "level" => ["label" => "Level", "transform" => function ($level) {
              return $level -> name;
            }]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\ClassModel::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.class.create"),
      "tooltip"    => "New Class",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new class",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new class.<br /> You'll only see this message once!"
    ])
  @endcan
@stop
@section("javascript")
<script>
$(".reset-filters").on("click", function (evt) {
  evt.preventDefault();
  window.location = "{{ route("admin.class.index") }}";
});
</script>
@stop