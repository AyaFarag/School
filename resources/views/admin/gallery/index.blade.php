@extends("admin.layout.app")

@section("navbar")
  <h4>Gallery</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.gallery.index"),
    "placeholder" => "Search by name/email"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.gallery",
          "notFound"      => "No gallery were found!",
          "items"         => $gallery,
          "model"         => \App\Models\Gallery::class,
          "columns"       => [
            "name"  => ["label" => "Name"],
            "email" => ["label" => "Email"]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Gallery::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.gallery.create"),
      "tooltip"    => "New gallery",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new video",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new gallery.<br /> You'll only see this message once!"
    ])
  @endcan
@stop