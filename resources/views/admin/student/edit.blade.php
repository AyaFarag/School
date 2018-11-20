@extends("admin.layout.app")

@section("navbar")
  <h4>Update student</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "put",
          "action" => route("admin.student.update", $student -> id)
        ])
          @include("admin.student.form")
          @include("admin.components.button", [
            "icon"  => "replay",
            "label" => "update"
          ])
        @endcomponent
      </div>
    </div>
  </div>
@stop