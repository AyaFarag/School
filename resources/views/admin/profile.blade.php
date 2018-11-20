@extends("admin.layout.app")

@section("navbar")
  <h4>Profile</h4>
@stop

@section("content")
  <div class="padded-container">
    <div class="card">
      <div class="card-content">
        @component("admin.components.form", [
          "method" => "put",
          "action" => route("admin.profile")
        ])
          @include("admin.components.input", [
            "name" => "name",
            "old"  => $admin -> name
          ])
          @include("admin.components.input", [
            "name" => "email",
            "old" => $admin -> email
          ])
          @include("admin.components.input", [
            "name" => "password",
            "type" => "password",
            "dontFlash" => true
          ])
          @include("admin.components.input", [
            "name"  => "password_confirmation",
            "label" => "Password Confirmation",
            "type"  => "password",
            "dontFlash" => true
          ])
          @include("admin.components.button", [
            "icon"  => "replay",
            "label" => "update"
          ])
        @endcomponent
      </div>
    </div>
  </div>
@stop