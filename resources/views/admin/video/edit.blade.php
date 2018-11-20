@extends("admin.layout.app")

@section("navbar")
  <h4>Videos</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "put",
          "enctype" => "multipart/form-data",
          "action" => route("admin.video.update", ["video" => $video -> id])
        ])
          @include("admin.video.form")
          @include("admin.components.button", [
            "icon"  => "replay",
            "label" => "update"
          ])
        @endcomponent
      </div>
    </div>
  </div>
@stop