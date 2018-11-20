@include("admin.components.input", [
  "name" => "name",
  "old"  => isset($class) ? $class -> name : ""
])

@include("admin.components.select", [
  "label" => "Level",
  "name" => "level_id",
  "options" => $levels,
  "old"  => isset($class) ? $class -> level -> id : ""
])