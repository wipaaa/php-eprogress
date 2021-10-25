@extends('layout.main')

@section('email', $user->email)
@section('name', $user->nama)
@section('profile', asset($user->avatar))
@section('title', 'Update Mahasiswa')

@section('content')
	@include('component.alert')
	<main class="mt-3">
		<form
			action="{{ route('main.put.user.update', ['id' => $user->id]) }}"
			method="POST"
			enctype="multipart/form-data">
			@method('put')
			<header><h3>Biodataku</h3></header>
			<main class="row gap-3 mt-4">
				<div class="col-3">
					<img
						src="{{ asset($user->avatar) }}"
						class="img-thumbnail rounded"
						alt="{{ $user->nim}}'s image profile"
						style="width: 250px; height: 250px; object-fit: cover;"/>
					@if ($user->id === $user->id)
						<div class="mt-3">
							<label for="formFile" class="form-label">Ganti Profile</label>
							<input class="form-control" type="file" id="formFile" name="avatar">
						</div>
					@endif
				</div>
				<div class="col">
						@method('put')
						<div class="form-floating mb-3">
							<input
								type="text"
								class="form-control"
								id="inp-nama"
								name="nama"
								value="{{ $user->nama }}"
								autocomplete="off" />
							<label for="inp-nama">Nama</label>
						</div>
						<div class="form-floating mb-3">
							<input
								type="email"
								class="form-control"
								id="inp-email"
								name="email"
								value="{{ $user->email }}"
								autocomplete="off" />
							<label for="inp-email">Email</label>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-floating mb-3">
									<input
										type="text"
										class="form-control"
										id="inp-phone"
										name="phone"
										value="{{ $user->phone }}"
										autocomplete="off" />
									<label for="inp-phone">No. HP</label>
								</div>
							</div>
							<div class="col">
								<div class="form-floating mb-3">
									<input
										type="text"
										class="form-control"
										id="inp-nim"
										name="nim"
										value="{{ $user->nim }}"
										autocomplete="off"
										disabled />
									<label for="inp-nim">NIM</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-floating mb-3">
									<input
										type="text"
										class="form-control"
										id="inp-prodi"
										name="prodi"
										value="{{ $user->prodi->nama }}"
										autocomplete="off"
										disabled />
									<label for="inp-prodi">Program Studi</label>
								</div>
							</div>
							<div class="col">
								<div class="form-floating mb-3">
									<input
										type="text"
										class="form-control"
										id="inp-akses"
										name="akses"
										value="{{ $user->akses->nama }}"
										autocomplete="off"
										disabled />
									<label for="inp-akses">Status</label>
								</div>
							</div>
						</div>
				</div>
				<div class="col-3">
					<button
						type="submit"
						class="btn w-100 btn-primary d-flex align-items-center mb-2">
						<i class="ri-refresh-line me-2"></i>
						<span>Simpan Perubahan</span>
					</button>
				</div>
			</main>
		</form>
	</main>
@endsection
