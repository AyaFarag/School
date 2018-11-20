@extends("admin.layout.app")

@section("navbar")
  <h4>Subjects</h4>
  @include("admin.components.navbar-search", [
    "route"       => route("admin.subject.index"),
    "placeholder" => "Search by name"
  ])
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-table", [
          "baseRouteName" => "admin.subject",
          "notFound"      => "No subjects were found!",
          "items"         => $subjects,
          "model"         => \App\Models\Subject::class,
          "columns"       => [
            "name" => ["label" => "Name"]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Subject::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.subject.create"),
      "tooltip"    => "New Subject",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new subject",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new subject.<br /> You'll only see this message once!"
    ])
  @endcan
@stop
@section("javascript")
<script>
$(".reset-filters").on("click", function (evt) {
  evt.preventDefault();
  window.location = "{{ route("admin.subject.index") }}";
});
</script>
@stop