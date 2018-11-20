@extends("admin.layout.base")

@section("body")
<div class="container">
  <div class="valign-wrapper full-vheight">
    <div class="row" style="flex : 1">
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card z-depth-2">
          <div class="card-content">
            <div class="card-title">{{ config('app.name') }} Admin Login</div>
            <form method="POST" action="{{ route('admin.login') }}">
              @csrf
              @include("admin.components.input", [
                "name"  => "email",
                "label" => "Email",
                "class" => "margin-top big"
              ])

              @include("admin.components.input", [
                "name" => "password",
                "type" => "password",
                "label" => "Password"
              ])
              <div class="flex justify-end">
                <button class="btn waves-effect waves-light" type="submit" name="action">Login
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop