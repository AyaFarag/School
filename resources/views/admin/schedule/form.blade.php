<div class="row">
  <div class="col-xs-12">
    @include("admin.components.select", [
      "label" => "Day",
      "name" => "day",
      "options" => [
        "saturday"  => "Saturday",
        "sunday"    => "Sunday",
        "monday"    => "Monday",
        "tuesday"   => "Tuesday",
        "wednesday" => "Wednesday",
        "thursday"  => "Thursday",
        "friday"    => "Friday"
      ],
      "old"  => isset($schedule) ? $schedule -> day : ""
    ])    
  </div>
  <div class="col-md-6">
    @include("admin.components.input", [
      "label" => "From",
      "name" => "from",
      "type" => "time",
      "old"  => isset($schedule) ? $schedule -> from : ""
    ])
  </div>
  <div class="col-md-6">
    @include("admin.components.input", [
      "label" => "To",
      "name" => "to",
      "type" => "time",
      "old"  => isset($schedule) ? $schedule -> to : ""
    ])
  </div>
</div>