@extends("admin.layout.app")

@section("navbar")
  <h4>Semester Sessions</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "get",
          "action" => route("admin.semester-session.index"),
          "noCsrf" => true
        ])
          <div class="row">
            <div class="col-xs-12 col-md-6">
              @include("admin.components.select", [
                "label"   => "Level - Class",
                "name"    => "class_id",
                "options" => $classes,
                "old"     => request() -> input("class_id")
              ])
            </div>
            <div class="col-xs-12 col-md-6">
              @include("admin.components.select", [
                "label"   => "Subject",
                "name"    => "subject_id",
                "options" => $subjects,
                "old"     => request() -> input("subject_id")
              ])
            </div>
            <div class="col-xs-12 col-md-6">
              @include("admin.components.select", [
                "label"   => "Teacher",
                "name"    => "teacher_id",
                "options" => $teachers,
                "old"     => request() -> input("teacher_id")
              ])
            </div>
            <div class="col-xs-12 col-md-6">
              @include("admin.components.select", [
                "label"   => "Year",
                "name"    => "year_id",
                "options" => $years,
                "old"     => request() -> input("year_id")
              ])
            </div>
          </div>
          <div class="flex justify-end margin-top">
            @include("admin.components.button", [
              "label" => "Reset",
              "icon" => "replay",
              "class" => "reset-filters margin-right",
              
            ])
            <div data-action="{{ route("admin.semester-session.index") }}">
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
          "baseRouteName" => "admin.semester-session",
          "notFound"      => "No semester sessions were found!",
          "items"         => $semesterSessions,
          "model"         => \App\Models\SemesterSession::class,
          "columns"       => [
            "class" => ["label" => "Level - Class", "transform" => function ($class) {
              return $class -> level -> name . " - " . $class -> name;
            }],
            "subject" => ["label" => "Subject", "transform" => function ($subject) {
              return $subject -> name;
            }],
            "teacher" => ["label" => "Branch - Teacher", "transform" => function ($teacher) {
              return $teacher -> name;
            }]
          ],
          "actions" => [[
            "icon" => "schedule",
            "tooltip" => "Scheules",
            "route" => function ($item) { return route("admin.semester-session.schedule.index", $item -> id); }
          ]]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\SemesterSession::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.semester-session.create"),
      "tooltip"    => "New Semester Session",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new semester session",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new semester session.<br /> You'll only see this message once!"
    ])
  @endcan
@stop
@section("javascript")
<script>
$(".reset-filters").on("click", function (evt) {
  evt.preventDefault();
  window.location = "{{ route("admin.semester-session.index") }}";
});
</script>
@stop