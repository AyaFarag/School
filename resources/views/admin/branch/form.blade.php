@include("admin.components.input", [
  "name" => "name",
  "label" => "Name",
  "old"  => isset($branch) ? $branch -> name : ""
])
@include("admin.components.input", [
  "name" => "address",
  "label" => "Address",
  "old"  => isset($branch) ? $branch -> address : ""
])

