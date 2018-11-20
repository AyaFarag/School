@extends("admin.layout.app")

@section("navbar")
  <div class="nav-wrapper">
    <div class="col s12">
      <a href="{{ route("admin.student.index") }}" class="breadcrumb">Students</a>
      <a href="{{ route("admin.student.show", $student -> id) }}" class="breadcrumb">{{ $student -> name }}</a>
      <a href="{{ route("admin.student.year.show", [$student -> id, $year -> id]) }}" class="breadcrumb">Data</a>
      <a href="{{ route("admin.student.year.point.index", [$student -> id, $year -> id]) }}" class="breadcrumb">Points</a>
    </div>
  </div>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @include("admin.components.crud-tablev2", [
          "notFound"      => "No points records were found!",
          "items"         => $points,
          "model"         => \App\Models\StudentPoint::class,
          "columns"       => [
            "points" => ["label" => "Points"],
            "created_at" => ["label" => "Date", "transform" => function ($value) {
              return \Carbon\Carbon::parse($value) -> format("Y-m-d");
            }],
            "reason" => ["label" => "Reason"]
          ]
        ])
      </div>
    </div>
  </div>
@stop