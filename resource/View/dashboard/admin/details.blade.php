@extends('layout.main')

@section('email', $user->email)
@section('name', $user->nama)
@section('profile', asset($user->avatar))
@section('title', 'Detail Mahasiswa')

@section('content')
	<a href="{{ route('main.get.dashboard') }}">
		&larr; Back
	</a>

	<main class="mt-3">
		<header class="d-flex align-items-center justify-content-between">
			<h3>Detail Mahasiswa</h3>
		</header>
		<main class="row gap-3 mt-4">
			<div class="col-3">
				<img
					src="{{ asset($student->avatar) }}"
					class="img-thumbnail rounded"
					alt="{{ $student->nim}}'s image profile"
					style="width: 250px; height: 250px; object-fit: cover;"/>
			</div>
			<div class="col">
				<div class="mb-3">
					<small class="text-muted">Nama</small>
					<h5>{{ $student->nama }}</h5>
				</div>
				<div class="mb-3">
					<small class="text-muted">Email</small>
					<h5>{{ $student->email }}</h5>
				</div>
				<div class="mb-3">
					<small class="text-muted">No. HP</small>
					<h5>{{ $student->phone }}</h5>
				</div>
				<div class="mb-3">
					<small class="text-muted">NIM</small>
					<h5>{{ $student->nim }}</h5>
				</div>
				<div class="mb-3">
					<small class="text-muted">Program Studi</small>
					<h5>{{ $student->prodi->nama }}</h5>
				</div>
				<div class="mb-3">
					<small class="text-muted">Status</small>
					<h5>
						{{ ucfirst($student->akses->nama) }}
						-
						{{ $student->akses->id === '1' ? 'Pengurus' : 'Anggota' }}
					</h5>
				</div>
			</div>
			<div class="col-3">
				<a
					href="{{ route('main.get.user.update', ['id' => $student->id]) }}"
					class="btn btn-warning d-flex align-items-center mb-2 text-light">
					<i class="ri-pencil-line me-2"></i>
					<span>Edit Biodata</span>
				</a>
				@if ($student->id === $user->id)
					<a
						href="{{ route('main.get.user.delete', ['id' => $student->id]) }}"
						class="btn btn-dark d-flex align-items-center mb-2">
						<i class="ri-lock-line me-2"></i>
						<span>Edit Password</span>
					</a>
				@endif
				@if ($student->id !== $user->id || $student->akses->id !== '1')
					<a
						href="{{ route('main.get.user.delete', ['id' => $student->id]) }}"
						class="btn btn-danger d-flex align-items-center mb-2">
						<i class="ri-delete-bin-line me-2"></i>
						<span>Hapus Anggota</span>
					</a>
				@endif
			</div>
		</main>
	</main>
@endsection
