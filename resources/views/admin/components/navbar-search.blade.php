<div class="navbar-search-container">
  @component("admin.components.form", [
    "method" => "get",
    "action" => $route,
    "class"  => "flex align-center navbar-search lighten-1 " . config("sidebar-menu")["colors"]["primary-name"],
    "noCsrf" => true
  ])
    @include("admin.components.rounded-button", [
      "icon"  => "search",
      "class" => "prefix"
    ])
    <input type="text" name="query" placeholder="{{ $placeholder }}" value="{{ request() -> input('query') }}" />
  @endcomponent
</div>