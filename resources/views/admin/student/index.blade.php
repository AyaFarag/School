@extends("admin.layout.app")

@section("navbar")
  <h4>Students</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.student.index"),
    "placeholder" => "Search by name"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "get",
          "action" => route("admin.student.index"),
          "noCsrf" => true
        ])
          <div class="row">
            <div class="col-md-6">
              @include("admin.components.select", [
                "label"   => "Level",
                "name"    => "level_id",
                "options" => $levels,
                "old"     => request() -> input("level_id")
              ])
            </div>
            <div class="col-md-6">
              @include("admin.components.select", [
                "label"   => "Branch",
                "name"    => "branch_id",
                "options" => $branches,
                "old"     => request() -> input("branch_id")
              ])
            </div>
          </div>
          <div class="flex justify-end margin-top">
            @include("admin.components.button", [
              "label" => "Reset",
              "icon" => "replay",
              "class" => "reset-filters margin-right",
              
            ])
            <div data-action="{{ route("admin.student.index") }}">
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
          "baseRouteName" => "admin.student",
          "notFound"      => "No students were found!",
          "items"         => $students,
          "model"         => \App\Models\Student::class,
          "actions"       => [
            [
              "route" => function ($item) { return route("admin.student.show", $item -> id); },
              "icon" => "open_in_new",
              "tooltip" => "Show Data"
            ]
          ],
          "columns"       => [
            "name" => ["label" => "Name"],
            "branch" => ["label" => "Branch", "transform" => function ($value) {
              return $value -> name;
            }],
            "level_class" => [
              "label" => "Level - Class",
              "transform" => function ($value, $item) {
                $class = $item -> classes -> first();
                return $class -> level -> name . " - " . $item -> name;
              }
            ]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Student::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.student.create"),
      "tooltip"    => "New Student",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new student",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new student.<br /> You'll only see this message once!"
    ])
  @endcan
@stop
@section("javascript")
<script>
$(".reset-filters").on("click", function (evt) {
  evt.preventDefault();
  window.location = "{{ route("admin.student.index") }}";
});
</script>
@stop