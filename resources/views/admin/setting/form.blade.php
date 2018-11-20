<div class="removable-select-input-container">
  <h5 class="margin-bottom big">Social Networks</h5>
  <div class="removable-select-input-items">
    @foreach ($setting -> social_networks as $social_network => $value)
      <div class="flex removable-select-input-group">
        <div class="flex align-center margin-right">
          @include("admin.components.rounded-button", [
            "icon"    => "close",
            "tooltip" => "Remove",
            "class"   => "remove-input"
          ])
        </div>
        <div style="flex : 1">
          @include("admin.components.input", [
            "name"  => "social_networks[" . $social_network . "]",
            "label" => ucfirst($social_network),
            "old"   => $value
          ])
        </div>
      </div>
    @endforeach
  </div>
  <div>
    @include("admin.components.select", [
      "options" => [
        "facebook" => "Facebook",
        "twitter"  => "Twitter",
        "instagram" => "Instagram"
      ],
      "label" => "Social Network",
      "class" => "removable-select-input-select"
    ])

    @include("admin.components.button", [
      "notSubmit" => true,
      "label"     => "Add",
      "icon"      => "add",
      "class"     => "add-input",
      "color"     => "secondary"
    ])
  </div>
</div>

<div class="removable-input-container">
  <h5 class="margin-bottom big">Emails</h5>
  <div class="removable-input-items">
    @foreach (empty($setting -> emails) ? [""] : $setting -> emails as $email)
      <div class="flex removable-input-group">
        <div class="flex align-center margin-right">
          @include("admin.components.rounded-button", [
            "icon"    => "close",
            "tooltip" => "Remove",
            "class"   => "remove-input"
          ])
        </div>
        <div style="flex : 1">
          @include("admin.components.input", [
            "name"  => "emails[" . $loop -> index . "]",
            "label" => "Email",
            "old"   => $email
          ])
        </div>
      </div>
    @endforeach
  </div>
  @include("admin.components.button", [
    "notSubmit" => true,
    "label"     => "Add",
    "icon"      => "add",
    "class"     => "add-input",
    "color"     => "secondary"
  ])
</div>

<div class="removable-input-container">
  <h5 class="margin-bottom big">Addresses</h5>
  <div class="removable-input-items">
    @foreach (empty($setting -> addresses) ? [""] : $setting -> addresses as $address)
      <div class="flex removable-input-group">
        <div class="flex align-center margin-right">
          @include("admin.components.rounded-button", [
            "icon"    => "close",
            "tooltip" => "Remove",
            "class"   => "remove-input"
          ])
        </div>
        <div style="flex : 1">
          @include("admin.components.input", [
            "name"  => "addresses[" . $loop -> index . "]",
            "label" => "Address",
            "old"   => $address
          ])
        </div>
      </div>
    @endforeach

  </div>
  @include("admin.components.button", [
    "notSubmit" => true,
    "label"     => "Add",
    "icon"      => "add",
    "class"     => "add-input",
    "color"     => "secondary"
  ])
</div>

<div class="removable-input-container">
  <h5 class="margin-bottom big">Phone Numbers</h5>
  <div class="removable-input-items">
    @foreach (empty($setting -> phone_numbers) ? [""] : $setting -> phone_numbers as $phone_number)
      <div class="flex removable-input-group">
        <div class="flex align-center margin-right">
          @include("admin.components.rounded-button", [
            "icon"    => "close",
            "tooltip" => "Remove",
            "class"   => "remove-input"
          ])
        </div>
        <div style="flex : 1">
          @include("admin.components.input", [
            "name"  => "phone_numbers[" . $loop -> index . "]",
            "label" => "Phone Number",
            "old"   => $phone_number
          ])
        </div>
      </div>
    @endforeach
  </div>
  @include("admin.components.button", [
    "notSubmit" => true,
    "label"     => "Add",
    "icon"      => "add",
    "class"     => "add-input",
    "color"     => "secondary"
  ])
</div>


<div class="removable-input-container">
  <h5 class="margin-bottom big">Websites</h5>
  <div class="removable-input-items">
    @foreach (empty($setting -> websites) ? [""] : $setting -> websites as $website)
      <div class="flex removable-input-group">
        <div class="flex align-center margin-right">
          @include("admin.components.rounded-button", [
            "icon"    => "close",
            "tooltip" => "Remove",
            "class"   => "remove-input"
          ])
        </div>
        <div style="flex : 1">
          @include("admin.components.input", [
            "name"  => "websites[" . $loop -> index . "]",
            "label" => "Website",
            "old"   => $website
          ])
        </div>
      </div>
    @endforeach
  </div>
  @include("admin.components.button", [
    "notSubmit" => true,
    "label"     => "Add",
    "icon"      => "add",
    "class"     => "add-input",
    "color"     => "secondary"
  ])
</div>



@section("javascript")
<script>

  function removeInput(evt) {
    evt.preventDefault();
    var $item = $(this).parents(".removable-input-group");
    if ($item.parents(".removable-input-items").find(".removable-input-group").length > 1)
      $item.remove();
  }

  $(".removable-input-container .remove-input").on("click", removeInput);

  $(".removable-input-container button.add-input").on("click", function (evt) {
    evt.preventDefault();

    var $parent = $(this).parents(".removable-input-container").find(".removable-input-items");

    var $clone = $parent.find(".removable-input-group").first().clone();
    var inputsCount = $parent.find(".removable-input-group").length;

    $clone.find(".remove-input").on("click", removeInput);

    $clone.find("input").each(function () {
      var $this = $(this);
      var oldName = $this.attr("name");
      var newName = oldName.replace(/\[\d+\]/, "[" + inputsCount + "]");
      $this.attr("name", newName);
      $this.attr("id", newName);
      $this.val("");
      $this.parent().find("label")
        .attr("for", newName)
        .removeClass("active");
    });

    $clone.appendTo($parent);
  });

  function removeSelectInput(evt) {
    evt.preventDefault();
    var $item = $(this).parents(".removable-select-input-group");
    if ($item.parents(".removable-select-input-items").find(".removable-select-input-group").length > 1)
      $item.remove();
  }


  $(".removable-select-input-container .remove-input").on("click", removeSelectInput);

  $(".removable-select-input-container button.add-input").on("click", function (evt) {
    evt.preventDefault();

    var $parent = $(this)
      .parents(".removable-select-input-container")
      .find(".removable-select-input-items");
    var $clone = $parent
      .find(".removable-select-input-group")
      .first()
      .clone();

    var $selectInput = $(this)
      .parents(".removable-select-input-container")
      .find(".removable-select-input-select");

    var selectInputValue = $selectInput.val();

    if (!selectInputValue || $parent.find("input[name*=\"" + selectInputValue + "\"]").length)
      return;

    $clone.find(".remove-input").on("click", removeSelectInput);

    $clone.find("input").each(function () {
      var $this = $(this);
      var oldName = $this.attr("name");
      var newName = oldName.replace(/\[\w+\]/, "[" + selectInputValue + "]");
      $this.attr("name", newName);
      $this.attr("id", newName);
      $this.val("");
      $this.parent().find("label")
        .text($selectInput.find("option:selected").text())
        .attr("for", newName)
        .removeClass("active");
    });

    $clone.appendTo($parent);
  });

</script>
@append