@extends("admin.layout.app")

@section("navbar")
  <h4>Moderators</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "put",
          "action" => route("admin.setting.edit")
        ])
          @include("admin.setting.form")
          @include("admin.components.button", [
            "icon"  => "replay",
            "label" => "update",
            "class" => "margin-top big"
          ])
        @endcomponent
      </div>
    </div>
  </div>
@stop