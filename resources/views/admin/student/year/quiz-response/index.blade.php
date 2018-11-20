@extends("admin.layout.app")

@section("navbar")
  <div class="nav-wrapper">
    <div class="col s12">
      <a href="{{ route("admin.student.index") }}" class="breadcrumb">Students</a>
      <a href="{{ route("admin.student.show", $student -> id) }}" class="breadcrumb">{{ $student -> name }}</a>
      <a href="{{ route("admin.student.year.show", [$student -> id, $year -> id]) }}" class="breadcrumb">Data</a>
      <a href="{{ route("admin.student.year.quiz-response.index", [$student -> id, $year -> id]) }}" class="breadcrumb">Quiz Answers</a>
    </div>
  </div>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @include("admin.components.crud-tablev2", [
          "notFound"      => "No quiz answers were found!",
          "items"         => $responses,
          "model"         => \App\Models\QuizResponse::class,
          "columns"       => [
            "quiz" => ["label" => "Quiz", "transform" => function ($quiz) { return $quiz -> title; }],
            "quiz_total" => ["label" => "Quiz total points", "transform" => function ($value, $item) { return $item -> quiz -> grade; }],
            "points" => ["label" => "Points gained"]
          ]
        ])
      </div>
    </div>
  </div>
@stop