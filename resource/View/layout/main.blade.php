@include('template.header')
	@include('component.alert')
	@section('sidebar')
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">@yield('title')</a>
				<button
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navbarNav"
					aria-controls="navbarNav"
					aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a
								href="{{ route('main.get.dashboard') }}"
								class="nav-link">Home</a>
						</li>
					</ul>
					<ul class="navbar-nav ms-auto">
						<li class="nav-item dropdown">
							<a
								href="#"
								class="nav-link dropdown-toggle"
								id="userProfileDropdown"
								role="button"
								data-bs-toggle="dropdown"
								aria-expanded="false">
								<span class="text-muted me-2">@yield('name')</span>
							</a>
							<ul
								id="user-dropdown"
								class="dropdown-menu dropdown-menu-end pt-4 pb-1"
								aria-labelledby="userProfileDropdown">
								<li>
									<img
										src="@yield('profile')"
										class="d-block mx-auto img-fluid rounded-circle"
										alt="user image profile"
										style="width: 100px; height: 100px; object-fit: cover" />
									<span
										class="d-block mt-3 text-center">
										@yield('name')
									</span>
									<small
										class="d-block text-center text-muted">
										@yield('email')
									</small>
								</li>
								<li class="mt-3">
									<a
										href="{{ route('main.get.user.update', ['id' => session('prefetch')]) }}"
										class="d-flex align-items-center dropdown-item py-2">
										<i class="text-primary ri-user-line"></i>
										<span class="d-block ms-3">Biodata</span>
									</a>
								</li>
								<li>
									<a
										href=""
										class="d-flex align-items-center dropdown-item py-2">
										<i class="text-warning ri-lock-line"></i>
										<span class="d-block ms-3">Ganti Password</span>
									</a>
								</li>
								<li>
									<a
										href="{{ route('auth.get.signout') }}"
										class="d-flex align-items-center dropdown-item py-2">
										<i class="text-danger ri-logout-circle-line"></i>
										<span class="d-block ms-3">Sign Out</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	@show
	<div class="container pt-4">
		@yield('content')
	</div>
@include('template.footer')
