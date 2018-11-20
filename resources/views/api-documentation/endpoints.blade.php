<!DOCTYPE html>
<html>
<head>
  <title>API Documentation</title>
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/materialize.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/flexboxgrid.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/apidocs.css" />
</head>
<body>
  <nav class="{{ config("sidebar-menu")["colors"]["primary-name"] }}">
    <div class="nav-wrapper flex space-between align-center">
      <div class="col s12">
        <a href="{{ route("apidocs") }}" class="breadcrumb">Endpoints</a>
      </div>
    </div>
  </nav>
  <div class="margin-top margin-bottom padding-horizontal">
    <h5>Filter</h5>
    @component("admin.components.form", [
      "method" => "get",
      "action" => route("apidocs"),
      "noCsrf" => true
    ])
      <div class="row margin-top">
        @foreach (App\Supports\ApiDocumentation::CATEGORIES as $category)
          <div class="col-md-2 col-sm-3 col-xs-6">
            @include("admin.components.checkbox", [
              "label"   => ucfirst($category),
              "name"    => "categories[]",
              "value"   => $category,
              "checked" => in_array($category, request()->input("categories") ?: [])
            ])
          </div>
        @endforeach
      </div>
      @include("admin.components.button", [
        "icon"  => "filter_list",
        "label" => "filter",
        "position" => "justify-start"
      ])
    @endcomponent
  </div>

  <div class="card endpoints">
    <div class="card-content">
      <div class="card-title">Endpoints</div>
      <table>
        <thead>
          <tr>
              <th></th>
              <th>Method</th>
              <th>Name</th>
              <th>URL</th>
              <th>Description</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($endpoints as $endpoint)
            <tr>
              <td style="width : 48px">
                <a href="{{ route("apidocs.endpoint", ["route" => $endpoint["url"], "method" => $endpoint["method"]]) }}">
                  @include("admin.components.rounded-button", [
                    "icon"    => "open_in_new",
                    "tooltip" => "Open"
                  ])
                </a>
              </td>
              <td style="width : 100px">
                @php
                  $method = strtolower($endpoint["method"]);
                @endphp
                @if ($method === "get")
                  <span class="badge green white-text">GET</span>
                @elseif ($method === "post")
                  <span class="badge purple white-text">POST</span>
                @elseif ($method === "put")
                  <span class="badge yellow">PUT</span>
                @elseif ($method === "delete")
                  <span class="badge red white-text">DELETE</span>
                @endif
              </td>
              <td class="font-mono">{{ $endpoint["url"] }}</td>
              <td>{{ $endpoint["name"] }}</td>
              <td>{{ $endpoint["description"] }}</td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <script type="text/javascript" src="/assets/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="/assets/admin/js/materialize.min.js"></script>
  <script>
    $(".tooltipped").tooltip();
  </script>
</body>
</html>
