@include("admin.components.input", [
  "name" => "name",
  "old"  => isset($moderator) ? $moderator -> name : ""
])
@include("admin.components.input", [
  "name" => "email",
  "old"  => isset($moderator) ? $moderator -> email : ""
])
@include("admin.components.input", [
  "name" => "password",
  "type" => "password",
  "dontFlash" => true
])
@include("admin.components.input", [
  "name" => "password_confirmation",
  "type" => "password",
  "label" => "Password Confirmation",
  "dontFlash" => true
])

@php
  $permissions = isset($moderator) ? $moderator -> permissions : [];
@endphp

<div>
  <h5 class="margin-bottom">Permissions</h5>
  @foreach(config("admin-permissions") as $key => $value)
    <div>{{ $key }}</div>
    <div class="row vertical-margin tied-checkboxes-container">
      @foreach($value as $item => $value)
        <p class="col l3">
          @php
            $checkboxProperties = [
              "label" => $value,
              "value" => $item,
              "name" => "permissions[]",
              "checked" => empty(old("permissions"))
                ? in_array($item, $permissions)
                : in_array($item, old("permissions"))
            ];
            if (strpos($item, "view") === false)
              $checkboxProperties["attributes"] = [
                "data-tiedto" => explode(":", $item)[0] . ":" . "view"
              ];
          @endphp
          @include("admin.components.checkbox", $checkboxProperties)
        </p>
      @endforeach
    </div>
  @endforeach
  <span class="helper-text is-danger">{{ $errors -> first("permissions") }}</span>
</div>


@section("javascript")
<script>
$(".tied-checkboxes-container input[type=\"checkbox\"][data-tiedTo]").on("change", function () {
  if (!$(this).is(":checked"))
    return;

  $(this)
    .parents(".tied-checkboxes-container")
    .find("input[type=\"checkbox\"][value=\"" + $(this).data("tiedto") + "\"]")
    .prop("checked", true);
});

</script>
@append