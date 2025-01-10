<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casual Friends - @yield('title')</title>

  <!-- Link to Bootstrap CSS for Styling -->
  @notifyCss
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Optional: Add custom styles -->
  <style>
    body {
      background-color: #f4f4f4;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid d-flex align-items-center">
      <a class="navbar-brand" href="{{ route('home') }}">Casual Friends</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto d-flex align-items-center">
          <li class="nav-item">
            <form class="d-flex" action="{{ route('search') }}" method="GET">
              <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search"
                name="query">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </li>
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
          @endguest
          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ route('profile') }}">
                <img
                  src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/40' }}"
                  class="rounded-circle" alt="Profile Picture" style="width: 40px; height: 40px; cursor: pointer;">
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white bg-danger p-2 rounded" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>


  <!-- Main Content -->
  <div class="container">
    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <x-notify::notify />
  @notifyJs
</body>

</html>
