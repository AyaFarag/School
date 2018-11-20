@extends("admin.layout.app")

@section("navbar")
  <h4>Update teacher</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "put",
          "action" => route("admin.teacher.update", $teacher -> id)
        ])
          @include("admin.teacher.form")
          @include("admin.components.button", [
            "icon"  => "replay",
            "label" => "update"
          ])
        @endcomponent
      </div>
    </div>
  </div>
@stop