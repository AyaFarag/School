<!DOCTYPE html>
<html>
<head>
  <title>API Documentation - {{ $endpoint["url"] }}</title>
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/materialize.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/flexboxgrid.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/admin/css/apidocs.css" />
</head>
<body>
  <nav class="{{ config("sidebar-menu")["colors"]["primary-name"] }}">
    <div class="nav-wrapper flex space-between align-center">
      <div class="col s12">
        <a href="{{ route("apidocs") }}" class="breadcrumb">Endpoints</a>
        <a href="{{ route("apidocs.endpoint", ["route" => $endpoint["url"]]) }}" class="breadcrumb">{{ $endpoint["name"] }}</a>
      </div>
    </div>
  </nav>
  <div class="card endpoint">
    <div class="card-content">
      <div class="card-title">{{ $endpoint["name"] }}</div>
      <h5 class="url-method">
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
        {{ $endpoint["url"] }}
      </h5>
      <p>{{ $endpoint["description"] }}</p>

      <h5 class="text-centered">Request</h5>
      <div class="card margin-top big">
        <div class="card-content">
          <div class="margin-top big">
            <h5 class="text-centered">Headers</h5>
            <table>
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($endpoint["headers"] as $headerName => $headerValue)
                  <tr>
                    <td>{{ $headerName }}</td>
                    <td>{{ $headerValue }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="margin-top big">
            <h5 class="text-centered">Parameters</h5>
            <table>
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Method</th>
                    <th>Rules</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($endpoint["parameters"]() as $parameter)
                  <tr>
                    <td style="width : 200px">{{ $parameter["name"] }}</td>
                    <td style="width : 100px">
                      @php
                        $method = strtolower($parameter["type"]);
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
                    <td>
                      @foreach (explode("[#]", $parameter["validation"]) as $rule)
                        <span class="chip">{{ $rule }}</span>
                      @endforeach
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <h5 class="text-centered margin-top big">Responses</h5>
      <div class="card margin-top big">
        <div class="card-content">
          @foreach ($endpoint["responses"]() as $response)
            <h5 class="text-centered">{{ $response["code"] }}</h5>
            <div><?php 
              if( is_array( $response["data"] ) )
                  dump(json_decode(json_encode($response["data"])));
              else
                  dump(json_decode($response["data"]));
              ?>
            </div>
            <div class="divider"></div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="/assets/admin/js/jquery.min.js"></script>
  <script type="text/javascript" src="/assets/admin/js/materialize.min.js"></script>
  <script>
    $(".tooltipped").tooltip();
  </script>
</body>
</html>
