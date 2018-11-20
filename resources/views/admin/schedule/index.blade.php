@extends("admin.layout.app")

@section("navbar")
  <h4>Semester Sessions - Schedules</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content no-padding">
        @include("admin.components.crud-tablev2", [
          "notFound" => "No schedules were found!",
          "items"    => $schedules,
          "model"    => \App\Models\Schedule::class,
          "columns"  => [
            "day" => ["label" => "Day", "transform" => function ($value) { return ucfirst($value); }],
            "from" => ["label" => "From"],
            "to" => ["label" => "To"]
          ],
          "actions" => [
            [
              "route" => function ($item) { return route("admin.semester-session.schedule.edit", [
                $item -> semester_session_id,
                $item -> id
              ]); },
              "icon" => "edit",
              "tooltip" => "Update"
            ],
            [
              "route" => function ($item) { return route("admin.semester-session.schedule.destroy", [$item -> semester_session_id, $item -> id]); },
              "icon" => "delete",
              "tooltip" => "Delete",
              "action" => "DELETE"
            ]
          ]
        ])
      </div>
    </div>
  </div>
  @can("create", \App\Models\Schedule::class)
    @include("admin.components.floating-fab", [
      "to"         => route("admin.semester-session.schedule.create", $semester_session -> id),
      "tooltip"    => "New Schedule",
      "attributes" => [
        "id" => "create-item"
      ]
    ])
    @include("admin.components.feature-discovery", [
      "target"  => "create-item",
      "title"   => "Create a new schedule session",
      "color"   => "secondary",
      "content" => "You can click on this floating fab to create a new schedule session.<br /> You'll only see this message once!"
    ])
  @endcan
@stop