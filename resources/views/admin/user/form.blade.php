@include("admin.components.input", [
  "name" => "name",
  "old"  => isset($user) ? $user -> name : ""
])
@include("admin.components.input", [
  "name" => "email",
  "old"  => isset($user) ? $user -> email : ""
])
@include("admin.components.input", [
  "name"  => "phones[]",
  "label" => "Phone number",
  "old"   => isset($user) ? $user -> phone : ""
])
@include("admin.components.input", [
  "name"      => "password",
  "type"      => "password",
  "dontFlash" => true
])
@include("admin.components.input", [
  "name"      => "password_confirmation",
  "type"      => "password",
  "label"     => "Password Confirmation",
  "dontFlash" => true
])
<div>
  <h5 class="margin-bottom">Account Status</h5>
  @include("admin.components.switch", [
    "name"     => "activated",
    "offLabel" => "not activated",
    "onLabel"  => "activated",
    "old"      => isset($user) ? $user -> activated : false
  ])
</div>