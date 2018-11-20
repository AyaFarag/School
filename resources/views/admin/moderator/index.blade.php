@extends("admin.layout.app")

@section("navbar")
  <h4>Moderators</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.moderator.index"),
    "placeholder" => "Search by name/email"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.moderator",
          "notFound"      => "No moderators were found!",
          "items"         => $moderators,
          "model"         => \App\Models\Admin::class,
          "columns"       => [
            "name"  => ["label" => "Name"],
            "email" => ["label" => "Email"]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Admin::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.moderator.create"),
      "tooltip"    => "New Moderator",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new moderator",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new moderator.<br /> You'll only see this message once!"
    ])
  @endcan
@stop