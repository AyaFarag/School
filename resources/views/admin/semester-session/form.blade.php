@include("admin.components.select", [
  "label" => "Level - Class",
  "name" => "class_id",
  "options" => $classes,
  "old"  => isset($semester_session) ? $semester_session -> class_id : ""
])

@include("admin.components.select", [
  "label" => "Subject",
  "name" => "subject_id",
  "options" => $subjects,
  "old"  => isset($semester_session) ? $semester_session -> subject_id : ""
])

@include("admin.components.select", [
  "label" => "Branch - Teacher",
  "name" => "teacher_id",
  "options" => $teachers,
  "old"  => isset($semester_session) ? $semester_session -> teacher_id : ""
])

@include("admin.components.select", [
  "label" => "Year",
  "name" => "year_id",
  "options" => $years,
  "old"  => isset($semester_session) ? $semester_session -> year_id : ""
])