@extends("admin.layout.app")

@section("navbar")
  <h4>Branches</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.branch.index"),
    "placeholder" => "Search by name/email"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.branch",
          "notFound"      => "No branchs were found!",
          "items"         => $branch,
          "model"         => \App\Models\Branch::class,
          "columns"       => [
            "name"  => ["label" => "Name"],
            "address" => ["label" => "Address"]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Branch::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.branch.create"),
      "tooltip"    => "New Branch",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new branch",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new branch.<br /> You'll only see this message once!"
    ])
  @endcan
@stop