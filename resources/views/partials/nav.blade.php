<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
	<div class="container-fluid">
		<a class="navbar-brand fw-bold" href="/">
			<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/Valorant_logo_-_pink_color_version.svg/2560px-Valorant_logo_-_pink_color_version.svg.png"
				style="max-width: 50px" alt="">
		</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ request()->is('joueur*') ? 'active' : '' }}"
						href="{{ route('joueur.index') }}">Players</a>
				</li>
				<li class="nav-item dropdown {{ request()->is('equipe*') ? 'active' : '' }}">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
						data-bs-toggle="dropdown" aria-expanded="false">
						Teams
					</a>
					<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
						<li>
							<a class="dropdown-item {{ request()->is('equipe/masculine*') ? 'active' : '' }}"
								href="{{ route('equipe.masculin.index') }}">
								Masculine
							</a>
						</li>
						<li>
							<a class="dropdown-item {{ request()->is('equipe/feminine*') ? 'active' : '' }}"
								href="{{ route('equipe.feminin.index') }}">
								Feminine
							</a>
						</li>
						<li>
							<a class="dropdown-item {{ request()->is('equipe/mixed*') ? 'active' : '' }}"
								href="{{ route('equipe.mixte.index') }}">
								Mixed
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="{{ route('equipe.index') }}">
								See All
							</a>
						</li>
					</ul>
				</li>
				@canany(['isAdmin'])
					<li class="nav-item">
						<a class="nav-link {{ request()->is('back/user*') ? 'active' : '' }}"
							href="{{ route('back.user.index') }}">
							See All Users
						</a>
					</li>
				@endcanany
				@canany(['isAdmin', 'isCoach'])
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarTeamDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							Teams
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarTeamDropdown">
							<li>
								<a class="dropdown-item {{ request()->is('back/joueur') ? 'active' : '' }}"
									href="{{ route('back.equipe.index') }}">See All Teams</a>
							</li>
							<li>
								<a class="dropdown-item {{ request()->is('back/equipe/create') ? 'active' : '' }}"
									href="{{ route('back.equipe.create') }}">Create Team</a>
							</li>
						</ul>
					</li>
				@endcanany
				@canany(['isAdmin', 'isCoach', 'isUser'])
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarPlayerDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							Players
						</a>
						<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarPlayerDropdown">
							<li>
								<a class="dropdown-item {{ request()->is('back/joueur') ? 'active' : '' }}"
									href="{{ route('back.joueur.index') }}">See All Players</a>
							</li>
							<li>
								<a class="dropdown-item {{ request()->is('back/joueur/create') ? 'active' : '' }}"
									href="{{ route('back.joueur.create') }}">Create Player</a>
							</li>

						</ul>
				@endcanany
			</ul>



			{{-- bouton de connexion/inscription --}}
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				@if(Route::has('login'))
					@auth
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
								data-bs-toggle="dropdown" aria-expanded="false">
								{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
							</a>
							<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="userDropdown">
								<li>
									<form method="POST" action="{{ route('logout') }}">
										@csrf
										<button type="submit" class="dropdown-item">Logout</button>
									</form>
								</li>
							</ul>
						</li>
					@else
						<li class="nav-item">
							<a href="{{ route('login') }}" class="nav-link">Log in</a>
						</li>
						@if(Route::has('register'))
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