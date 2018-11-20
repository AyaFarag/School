@extends("admin.layout.app")

@section("navbar")
  <h4>Teachers</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.teacher.index"),
    "placeholder" => "Search by name"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "get",
          "action" => route("admin.teacher.index"),
          "noCsrf" => true
        ])
          <div class="row">
            <div class="col-xs-12">
              @include("admin.components.select", [
                "label"   => "Branch",
                "name"    => "branch",
                "options" => $branches,
                "old"     => request() -> input("branch")
              ])
            </div>
          </div>
          <div class="flex justify-end margin-top">
            @include("admin.components.button", [
              "label" => "Reset",
              "icon" => "replay",
              "class" => "reset-filters margin-right",
              
            ])
            <div data-action="{{ route("admin.teacher.index") }}">
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
          "baseRouteName" => "admin.teacher",
          "notFound"      => "No teachers were found!",
          "items"         => $teachers,
          "model"         => \App\Models\Teacher::class,
          "columns"       => [
            "name" => ["label" => "Name"],
            "email" => ["label" => "Email"],
            "phone" => ["label" => "Phone"],
            "branch" => ["label" => "Branch", "transform" => function ($value) {
              return $value -> name;
            }]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Teacher::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.teacher.create"),
      "tooltip"    => "New Teacher",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new teacher",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new teacher.<br /> You'll only see this message once!"
    ])
  @endcan
@stop
@section("javascript")
<script>
$(".reset-filters").on("click", function (evt) {
  evt.preventDefault();
  window.location = "{{ route("admin.teacher.index") }}";
});
</script>
@stop