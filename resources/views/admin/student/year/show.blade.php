@extends("admin.layout.app")

@section("navbar")
  <div class="nav-wrapper">
    <div class="col s12">
      <a href="{{ route("admin.student.index") }}" class="breadcrumb">Students</a>
      <a href="{{ route("admin.student.show", $student -> id) }}" class="breadcrumb">{{ $student -> name }}</a>
      <a href="{{ route("admin.student.year.show", [$student -> id, $year -> id]) }}" class="breadcrumb">Data</a>
    </div>
  </div>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="flex margin-top big align-center">
              <div class="flex align-center">
                <i class="material-icons margin-right" style="font-size : 50px">sort</i>
                <h3>Statistics</h3>
              </div>
            </div>
            <div class="vertical-margin margin-left">
              <div class="flex margin-top align-center">
                <strong class="margin-right small" style="font-size : 18px">Student of the Day :</strong>
                <span class="washed-out">{{ $total_student_of_day }}</span>
              </div>
              <div class="flex margin-top align-center">
                <strong class="margin-right small" style="font-size : 18px">Total absence days :</strong>
                <span class="washed-out">{{ $total_absences }}</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="flex margin-top big align-center">
              <div class="flex align-center">
                <i class="material-icons margin-right" style="font-size : 50px">scatter_plot</i>
                <h3>Points</h3>
              </div>
            </div>
            <div class="vertical-margin margin-left">
              <div class="flex margin-top align-center">
                <strong class="margin-right small" style="font-size : 18px">Quiz points :</strong>
                <span class="washed-out">{{ $points["quiz"] }} out of {{ $total_quiz_points }}</span>
              </div>
              <div class="flex margin-top align-center">
                <strong class="margin-right small" style="font-size : 18px">Other points :</strong>
                <span class="washed-out">{{ $points["other"] }}</span>
              </div>
              <div class="flex margin-top align-center">
                <strong class="margin-right small" style="font-size : 18px">Student of day :</strong>
                <span class="washed-out">{{ $points["student_of_day"] }}</span>
              </div>
              <div class="flex margin-top align-center">
                <strong class="margin-right small" style="font-size : 18px">Total points :</strong>
                <span class="washed-out">
                  {{ array_reduce($points, function ($total, $n) { return $n + $total; }, 0) }}
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-xs-12">
            <div class="flex justify-center margin-top huge">
              <a class="horizontal-margin" href="{{ route("admin.student.year.absence.index", [$student -> id, $year -> id]) }}">
                @include("admin.components.button", [
                  "label" => "Absences",
                  "icon" => "weekend"
                ])
              </a>
              <a class="horizontal-margin" href="{{ route("admin.student.year.point.index", [$student -> id, $year -> id]) }}">
                @include("admin.components.button", [
                  "label" => "Points",
                  "icon" => "scatter_plot"
                ])
              </a>
              <a class="horizontal-margin" href="{{ route("admin.student.year.quiz-response.index", [$student -> id, $year -> id]) }}">
                @include("admin.components.button", [
                  "label" => "Quiz answers",
                  "icon" => "note"
                ])
              </a>
              <a class="horizontal-margin" href="{{ route("admin.student.year.student-of-day.index", [$student -> id, $year -> id]) }}">
                @include("admin.components.button", [
                  "label" => "Student of the Day",
                  "icon" => "how_to_reg"
                ])
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@stop