<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Demo</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y="
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css"
      integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY="
      crossorigin="anonymous"
    />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}" />
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>

  </head>

  <body>
    <nav
      class="navbar navbar-expand-lg navbar-dark bg-mattBlackLight fixed-top"
    >
      <button class="navbar-toggler sideMenuToggler" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>

      <a class="navbar-brand link"  href="#">{{ Auth::guard('admin')->user()->name }}</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle p-0"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="material-icons icon">
                person
              </i>
              <span class="text">Account</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{route('admin.logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
               <a class="dropdown-item" href="{{ route('admin.profile') }}">Profile</a>
               <a class="dropdown-item" href="{{ route('admin.profile.change') }}">Profile Change</a>

              <form id="logout-form" action="{{  route('admin.logout')}}" method="POST" class="d-none">
                  @csrf
              </form>
          </div>
          </li>
        </ul>
      </div>
    </nav>
  
    <div class="wrapper d-flex">
      <div class="sideMenu bg-mattBlackLight">
        <div class="sidebar" style="background-color:#000">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{route('admin.dashboard')}}" class="nav-link px-2">
                <i class="material-icons icon">
                  dashboard
                </i>
                <span class="text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link px-2">
                <i class="material-icons icon">
                  person
                </i>
                <span class="text">User Profile</span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('admin.profile')}}">Profile</a>
                <a class="dropdown-item" href="{{route('admin.profile.change')}}">Profile Change</a>
              </div>
            </li>
            @if (Auth::guard('admin')->user()->can('role.create') || Auth::guard('admin')->user()->can('role.all')
             || Auth::guard('admin')->user()->can('role.edit'))
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle px-2 "
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="material-icons icon">
                  person
                </i>
                <span class="text">Role</span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
              @if(Auth::guard('admin')->user()->can('role.create'))
                <a class="dropdown-item" href="{{route('role.create')}}">Create</a>
                @endif
              @if(Auth::guard('admin')->user()->can('role.all'))
                <a class="dropdown-item" href="{{route('role.all')}}">Role</a>
                @endif
              </div>
            </li>
            @endif

            @if (Auth::guard('admin')->user()->can('admins.create') || Auth::guard('admin')->user()->can('admins.all') 
            || Auth::guard('admin')->user()->can('admins.edit') )
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle px-2 "
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="material-icons icon">
                  person
                </i>
                <span class="text">User</span>
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbarDropdown"
              >
              @if(Auth::guard('admin')->user()->can('admins.create'))
                <a class="dropdown-item" href="{{route('admins.create')}}">Create</a>
                @endif
               @if(Auth::guard('admin')->user()->can('admins.all'))
                <a class="dropdown-item" href="{{route('admins.all')}}">User</a>
                @endif
              </div>
            </li>
            @endif
            
          </ul>
        </div>
      </div>
      <div class="content">
      @yield('content')
      </div>
    </div>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"
      integrity="sha256-OUFW7hFO0/r5aEGTQOz9F/aXQOt+TwqI1Z4fbVvww04="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"
      integrity="sha256-qE/6vdSYzQu9lgosKxhFplETvWvqAAlmAuR+yPh/0SI="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('backend/js/script.js')}}"></script>
    <script src="{{asset('js/admin/admin.js')}}"></script>
    @yield('scripts')
  </body>
</html>
