<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>

  <link rel="stylesheet" type="text/css" href="/assets/admin/css/materialize.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/flexboxgrid.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    .sidenav .collapsible-body > ul:not(.collapsible) > li.active,
    .sidenav.sidenav-fixed .collapsible-body > ul:not(.collapsible) > li.active {
      background : {{ config("sidebar-menu")["colors"]["primary"] }};
    }
  </style>
  @yield("css")
  <style>
    .sidenav .collapsible li.{{ implode(".", explode(" ", config("sidebar-menu")["colors"]["primary-name"])) }} > a,
    .sidenav .collapsible li.{{ implode(".", explode(" ", config("sidebar-menu")["colors"]["primary-name"])) }} > a > i {
      color : white!important;
    }
  </style>
</head>
<body>

@section("body")




@show

<script type="text/javascript" src="/assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/materialize.min.js"></script>
<script type="text/javascript" src="/assets/admin/js/script.js"></script>
@yield("javascript")
<script>
const activeNavChild = $(".collapsible .collapsible-body > ul > li.active");
if (activeNavChild.length) {
  activeNavChild.parents(".collapsible-body").parent().addClass("active");
}

// Show toasts
@if(Session::has("success") || Session::has("error"))
M.toast({
  html : "{!!
    Session::has('error')
      ? '<i class=\"material-icons left\">error</i>' . Session::get('error')
      : '<i class=\"material-icons left\">check</i>' . Session::get('success')
  !!}",
  displayLength : 6000
});
@endif

</script>
</body>
</html>