@extends("admin.layout.app")

@section("navbar")
  <h4>Videos</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "post",
          "enctype" => "multipart/form-data",
          "action" => route("admin.video.store")
        ])
          @include("admin.video.form")
          @include("admin.components.button", [
            "icon"  => "add",
            "label" => "create"
          ])
        @endcomponent
      </div>
    </div>
  </div>
@stop