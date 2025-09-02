<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="/">
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Valorant_logo_-_pink_color_version.svg/2560px-Valorant_logo_-_pink_color_version.svg.png"
        style="max-width: 50px" alt="">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('joueur*') ? 'active' : '' }}"
            href="{{ route('joueur.index') }}">Players</a>
        </li>
        <li class="nav-item dropdown {{ request()->is('equipe*') ? 'active' : '' }}">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Teams
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item {{ request()->is('equipe/feminine*') ? 'active' : '' }}" href="">
                Feminine
              </a>
            </li>
            <li>
              <a class="dropdown-item {{ request()->is('equipe/masculine*') ? 'active' : '' }}" href="">
                Masculine
              </a>
            </li>
            <li>
              <a class="dropdown-item {{ request()->is('equipe/mixed*') ? 'active' : '' }}" href="">
                Mixed
              </a>
            </li>
          </ul>
        </li>


      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @if (Route::has('login'))
          @auth
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link">Logout</button>
              </form>
            </li>
          @else
            <li class="nav-item">
              <a href="{{ route('login') }}" class="nav-link">Log in</a>
            </li>

            @if (Route::has('register'))
              <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Register</a>
              </li>
            @endif
          @endauth
        @endif
      </ul>
    </div>
  </div>
</nav>