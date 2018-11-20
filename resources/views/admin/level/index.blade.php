@extends("admin.layout.app")

@section("navbar")
  <h4>Levels</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.level.index"),
    "placeholder" => "Search by name"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.level",
          "notFound"      => "No level were found!",
          "items"         => $level,
          "model"         => \App\Models\Level::class,
            "columns"       => [
            "name"  => ["label" => "Level Name"],
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Level::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.level.create"),
      "tooltip"    => "New level",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new level",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new level.<br /> You'll only see this message once!"
    ])
  @endcan
@stop