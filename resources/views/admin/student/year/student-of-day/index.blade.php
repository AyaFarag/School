@extends("admin.layout.app")

@section("navbar")
  <div class="nav-wrapper">
    <div class="col s12">
      <a href="{{ route("admin.student.index") }}" class="breadcrumb">Students</a>
      <a href="{{ route("admin.student.show", $student -> id) }}" class="breadcrumb">{{ $student -> name }}</a>
      <a href="{{ route("admin.student.year.show", [$student -> id, $year -> id]) }}" class="breadcrumb">Data</a>
      <a href="{{ route("admin.student.year.student-of-day.index", [$student -> id, $year -> id]) }}" class="breadcrumb">Student of the day</a>
    </div>
  </div>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @include("admin.components.crud-tablev2", [
          "notFound"      => "No student of day awards were found!",
          "items"         => $student_of_days,
          "model"         => \App\Models\StudentOfDay::class,
          "columns"       => [
            "created_at" => ["label" => "Date", "transform" => function ($value) { return $value -> format(config("defaults.date_format")); }]
          ]
        ])
      </div>
    </div>
  </div>
@stop