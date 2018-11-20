@extends("admin.layout.app")

@section("navbar")
  <h4>Videos</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.video.index"),
    "placeholder" => "Search by name/email"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.video",
          "notFound"      => "No videos were found!",
          "items"         => $video,
          "model"         => \App\Models\Video::class,
          "columns"       => [
            "name"  => ["label" => "Name"],
            "email" => ["label" => "Email"]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Video::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.video.create"),
      "tooltip"    => "New video",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new video",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new video.<br /> You'll only see this message once!"
    ])
  @endcan
@stop