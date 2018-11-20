@extends("admin.layout.app")

@section("navbar")
  <h4>Update semester session</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "put",
          "action" => route("admin.semester-session.update", $semester_session -> id)
        ])
          @include("admin.semester-session.form")
          @include("admin.components.button", [
            "icon"  => "replay",
            "label" => "update"
          ])
        @endcomponent
      </div>
    </div>
  </div>
@stop