<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
<head>
    <script src="{{ asset('assets/js/color-modes.js') }}"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Guardian Track by Covert Results</title>
    <link rel="icon" type="image/png" sizes="48x48" href="../assets/dist/img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dist/css/custom.css') }}" rel="stylesheet">
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body class="d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
       <a class="navbar-brand" href="index.html"><img class="img-fluid" width="180px" src="{{ asset('assets/dist/img/logo-dark-.svg') }}"/></a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  @auth
                      Hello, {{ Auth::user()->name }} 
                  @else
                      Hello, Guest
                  @endauth
                  <img class="ms-2" width="40px" src="{{ asset('assets/dist/img/user.svg') }}"/>
              </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li>
                      <a class="dropdown-item " href="{{ route('profile.edit') }}">
                          <img class="img-fluid" width="30px" src="{{ asset('assets/dist/img/edit.svg') }}"/> Edit Profile
                      </a>
                  </li>
                 <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      <img class="img-fluid" width="30px" src="{{ asset('assets/dist/img/exit.svg') }}"/> Exit
                  </a>
              
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
                </ul>
             </li>
          </ul>
       </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light" aria-label="Offcanvas navbar large">
    <div class="container">
        <ul class="nav nav-underline">
            <li class="nav-item">
                <a class="nav-link{{ $currentRoute == 'map' ? ' active' : '' }}" href="{{ route('map') }}">Map</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ $currentRoute == 'devices.index' ? ' active' : '' }}" href="{{ route('devices.index') }}">Devices</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ $currentRoute == 'suspects.index' ? ' active' : '' }}" href="{{ route('suspects.index') }}">Suspect</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ $currentRoute == 'polygons.index' ? ' active' : '' }}" href="{{ route('polygons.index') }}">Polygons</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ $currentRoute == 'send.notification.form' ? ' active' : '' }}" href="{{ route('send.notification.form') }}">Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ $currentRoute == 'location-logs.index' ? ' active' : '' }}" href="{{ route('location-logs.index') }}">Locations Logs</a>
            </li>
            <li class="nav-item">
                @role('super')
                <a class="nav-link{{ $currentRoute == 'users.index' ? ' active' : '' }}" href="{{ route('users.index') }}">Users</a>
                @endrole
            </li>
        </ul>
    </div>
</nav>
@include('components.alert')

<!-- Contenido de la vista -->
@yield('content')

</body>
</html>
