$(document).ready(function(){
  $(".collapsible").collapsible();
  $(".sidenav").sidenav();
  $(".tooltipped").tooltip();
  $(".modal").modal();
  $("select").formSelect();
  $(".tap-target").tapTarget();
  $(".tabs").tabs();
  $(".datepicker").datepicker({
    format  : "yyyy-mm-dd",
    yearRange : 90
  });
  $(".timepicker").timepicker({ twelveHour : false });
  if (!localStorage.getItem("feature-discovery-add")) {
    setTimeout(function () {
      localStorage.setItem("feature-discovery-add", true);
      M.TapTarget.getInstance($(".tap-target")[0]).open();
    }, 2000);
  }

  var toBeDeleted = null;

  $(".delete-form button[type=\"submit\"]").on("click", function (evt) {
    evt.preventDefault();

    M.Modal.getInstance($("#confirmation")[0]).open();

    toBeDeleted = $(this).parents("form");
  });

  $("#confirmation-accept").on("click", function () {
    if (toBeDeleted) {
        console.log(toBeDeleted);
        toBeDeleted.submit();
    }
  });

  $("#confirmation-reject").on("click", function () {
    toBeDeleted = null;
  });

  $(".multisubmit button").on("click", function (evt) {
    evt.preventDefault();
    var action = $(this).parents(".multisubmit").data("action");
    var $form = $(this).parents("form");
    $form.attr("action", action)
    $form.submit();
  });

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

    var selects = [];

    $clone.find("input,select").each(function () {
      var $this = $(this);
      var oldName = $this.attr("name");
      if (!oldName) return;
      if ($this.is("select")) selects.push($this);
      var newName = oldName.replace(/\[\d+\]/, "[" + inputsCount + "]");
      $this.attr("name", newName);
      $this.attr("id", newName);
      $this.val("");
      $this.parent().find("label")
        .attr("for", newName)
        .removeClass("active");
    });

    $clone.appendTo($parent);
    // Handle the select element reinitialization
    selects.forEach(function (select) {
      var $clone = select.clone();
      var $container = select.parents(".input-field");
      $container.html("");
      $clone.appendTo($container);
      $clone.formSelect();
    });
  });
});