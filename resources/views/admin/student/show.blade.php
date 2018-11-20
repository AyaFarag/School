@extends("admin.layout.app")

@section("navbar")
  <h4>Students - {{ $student -> name }}</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        <div class="flex margin-top align-center">
          <div class="flex align-center">
            <i class="material-icons margin-right" style="font-size : 50px">person</i>
            <h3>Info</h3>
          </div>
        </div>
        <div class="vertical-margin margin-left">
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Name :</strong>
            <span class="washed-out">{{ $student -> name }}</span>
          </div>
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Phone :</strong>
            <span class="washed-out">{{ $student -> phone }}</span>
          </div>
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Branch :</strong>
            <span class="washed-out">{{ $student -> branch -> name }}</span>
          </div>
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Gender :</strong>
            <span class="washed-out">{{ ucfirst($student -> gender) }}</span>
          </div>
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Birth :</strong>
            <span class="washed-out">{{ $student -> birth_date -> toFormattedDateString() }}</span>
          </div>
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Year :</strong>
            @php
              $year = $student -> years() -> first();
            @endphp
            <span class="washed-out">{{ $year -> title }}</span>
          </div>
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Parent :</strong>
            <a href="{{ route("admin.parent.show", $student -> parent -> id) }}">{{ $student -> parent -> name }}</a>
          </div>
          <div class="flex margin-top align-center">
            <strong class="margin-right small" style="font-size : 18px">Class :</strong>
            <span class="washed-out">{{ $student -> classes() -> first() -> name }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-content">
        <div class="flex margin-top align-center">
          <div class="flex align-center">
            <i class="material-icons margin-right" style="font-size : 50px">timeline</i>
            <h3>Years</h3>
          </div>
        </div>
        <div class="vertical-margin margin-left">
          @include("admin.components.crud-tablev2", [
            "notFound" => "No yearas were found!",
            "items"    => $student -> years,
            "columns"  => [
              "from" => ["label" => "From"],
              "to" => ["label" => "To"],
            ],
            "actions" => [
              [
                "route" => function ($item) use ($student) { return route("admin.student.year.show", [$student -> id, $item -> id]); },
                "icon" => "open_in_new",
                "tooltip" => "Show Data"
              ]
            ]
          ])
        </div>
      </div>
    </div>
  </div>
@stop