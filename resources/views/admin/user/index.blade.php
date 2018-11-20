@extends("admin.layout.app")

@section("navbar")
  <h4>Users</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.user.index"),
    "placeholder" => "Search by name/email"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.user",
          "notFound"      => "No users were found!",
          "items"         => $users,
          "model"         => \App\Models\User::class,
          "columns"       => [
            "name"  => ["label" => "Name"],
            "email" => ["label" => "Email"]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\User::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.user.create"),
      "tooltip"    => "New User",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new user",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new user.<br /> You'll only see this message once!"
    ])
  @endcan
@stop