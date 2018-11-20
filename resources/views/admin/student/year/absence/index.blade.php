@extends("admin.layout.app")

@section("navbar")
  <div class="nav-wrapper">
    <div class="col s12">
      <a href="{{ route("admin.student.index") }}" class="breadcrumb">Students</a>
      <a href="{{ route("admin.student.show", $student -> id) }}" class="breadcrumb">{{ $student -> name }}</a>
      <a href="{{ route("admin.student.year.show", [$student -> id, $year -> id]) }}" class="breadcrumb">Data</a>
      <a href="{{ route("admin.student.year.absence.index", [$student -> id, $year -> id]) }}" class="breadcrumb">Absence</a>
    </div>
  </div>
@stop
@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @include("admin.components.crud-tablev2", [
          "notFound"      => "No absences records were found!",
          "items"         => $absences,
          "model"         => \App\Models\Absence::class,
          "columns"       => [
            "session" => ["label" => "Date", "transform" => function ($session) { return $session -> created_at -> format(config("defaults.date_format")); }],
            "has_permission" => ["label" => "With Permission", "transform" => function ($value) {
              if ($value)
                return "<div class=\"badge green\">YES</div>";
              else
                return "<div class=\"badge red\">NO</div>";
            }]
          ]
        ])
      </div>
    </div>
  </div>
@stop