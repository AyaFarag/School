@include("admin.components.input", [
  "name" => "name",
  "label" => "Level Name",
  "old"  => isset($level) ? $level -> name : "",

])

