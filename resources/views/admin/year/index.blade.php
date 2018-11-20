@extends("admin.layout.app")

@section("navbar")
  <h4>Years</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.year",
          "notFound"      => "No years were found!",
          "items"         => $years,
          "model"         => \App\Models\Year::class,
          "columns"       => [
            "id"   => ["label" => "ID"],
            "from" => ["label" => "From"],
            "to"   => ["label" => "To"]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Year::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.year.create"),
      "tooltip"    => "New Year",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new year",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new year.<br /> You'll only see this message once!"
    ])
  @endcan
@stop