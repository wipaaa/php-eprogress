@extends('layout.auth')
@section('title', $title)

@section('content')
	<div class="d-flex align-items-center justify-content-center vh-100 bg-light">
		<div class="content w-25">
			<header class="text-center">
				<i class="ri-code-view ri-3x"></i>
				<h4 class="mt-3">EProgress - Sign In</h4>
				<p class="text-muted">
					Aplikasi pengelolaan mahasiswa UKM Progress sederhana.
				</p>
				@if (session('error'))
					<small class="text-danger">{{ error('nim') }}</small>
					<small class="text-danger">{{ error('password') }}</small>
				@endif
			</header>
			<main class="mt-4">
				<form action="{{ route('auth.post.signin') }}" method="POST">
					<div class="form-floating mb-3">
						<input
							type="text"
							class="form-control"
							id="inp-nim"
							name="nim"
							placeholder="210030***"
							autocomplete="off" />
						<label for="inp-nim">NIM</label>
					</div>
					<div class="form-floating mb-4">
						<input
							type="password"
							class="form-control"
							id="inp-password"
							name="password"
							placeholder="210030***"
							autocomplete="off" />
						<label for="inp-password">Password</label>
					</div>
					<div class="d-flex justify-content-end">
						<button
							type="submit"
							class="btn btn-primary">
							Sign In
						</button>
					</div>
				</form>
			</main>
		</div>
	</div>
@endsection
