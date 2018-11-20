<ul id="slide-out" class="sidenav sidenav-fixed">
  <li
    style="line-height : normal; padding : 10px 18px"
  >
    <div class="flex align-center">
      <div style="flex : 1 0 20%">
        <img class="responsive-img" src="{{ config('sidebar-menu')['logo']['image'] }}" />
      </div>
      <div style="flex : 1 0 80%; margin-left : 20px">
        <strong>{{ config("sidebar-menu")["logo"]["text"] }}</strong>
      </div>
    </div>
  </li>
  <li class="divider"></li>
  {{--
  <li>
    <div class="nav-logo">
      <img class="responsive-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Firefox_Logo%2C_2017.svg/1200px-Firefox_Logo%2C_2017.svg.png" />
    </div>
  </li> --}}
  <li>
    <ul class="collapsible">
      <li
        @if (route(config("sidebar-menu")["links"]["profile"]) === url() -> current())
          class="active {{ config("sidebar-menu")["colors"]["primary-name"] }}"
        @endif
      >
        <a href="{{ route(config("sidebar-menu")["links"]["profile"]) }}" class="waves-effect waves-{{ config("sidebar-menu")["colors"]["primary-name"] }}">
          <div class="flex space-between align-center">
            <div>{{ auth("admin") -> user() -> name }}</div>
            <i class="material-icons">settings</i>
          </div>
        </a>
      </li>
      <li class="divider no-margin"></li>
      @foreach (config("sidebar-menu")["items"] as $item)
        @if (
          (
            array_key_exists("can", $item)
            && array_key_exists("model", $item)
          )
            ? auth() -> guard("admin") -> user() -> can($item["can"], $item["model"])
            : true
        )
          @if (!empty($item["submenu"]))
            <li>
              <div class="collapsible-header flex space-between align-center waves-effect waves-{{ config("sidebar-menu")["colors"]["primary-name"] }}">
                <div class="flex align-center">
                  @if (!empty($item["icon"]))
                    <i class="material-icons">{{ $item["icon"] }}</i>
                  @endif
                  <span>{{ $item["label"] }}</span>
                </div>
                <i class="material-icons">keyboard_arrow_down</i>
              </div>
              <div class="collapsible-body">
                <ul>
                  @foreach ($item["submenu"] as $subItem)
                    <li
                      @if (strpos(url() -> current(), route($sbuItem["route"])) !== false)
                        class="active {{ config("sidebar-menu")["colors"]["primary-name"] }}"
                      @endif
                    >
                      <a href="{{ route($subItem["route"]) }}" class="waves-effect waves-{{ config("sidebar-menu")["colors"]["primary-name"] }}">
                        @if (!empty($subItem["icon"]))
                          <i class="material-icons">{{ $subItem["icon"] }}</i>
                        @endif
                        {{ $subItem["label"] }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </li>
          @else
            <li
              @if (strpos(url() -> current(), route($item["route"])) !== false)
                class="active {{ config("sidebar-menu")["colors"]["primary-name"] }}"
              @endif
            >
              <a href="{{ route($item["route"]) }}" class="waves-effect waves-{{ config("sidebar-menu")["colors"]["primary-name"] }}">
                @if (!empty($item["icon"]))
                  <i class="material-icons">{{ $item["icon"] }}</i>
                @endif
                <span>{{ $item["label"] }}</span>
              </a>
            </li>
          @endif
        @endif
      @endforeach
      <li>
        <a href="{{ route(config("sidebar-menu")["links"]["logout"]) }}" class="waves-effect waves-{{ config("sidebar-menu")["colors"]["primary-name"] }}">
          <i class="material-icons">power_settings_new</i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </li>
</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>