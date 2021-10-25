@extends('layout.main')

@section('email', $user->email)
@section('name', $user->nama)
@section('profile', asset($user->avatar))
@section('title', 'Tambah Mahasiswa')

@section('content')
	<a href="{{ route('main.get.dashboard') }}">
		&larr; Back
	</a>

	<main class="mt-3">
		<form
			action="{{ route('main.post.create') }}"
			method="POST"
			enctype="multipart/form-data">
			<header><h3>Tambah Mahasiswa</h3></header>
			<main class="row gap-3 mt-4">
				<div class="col">
					<div class="form-floating mb-3">
						<input
							type="text"
							class="form-control"
							id="inp-nama"
							name="nama"
							autocomplete="off" />
						<label for="inp-nama">Nama</label>
					</div>
					<div class="form-floating mb-3">
						<input
							type="email"
							class="form-control"
							id="inp-email"
							name="email"
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
									autocomplete="off" />
								<label for="inp-nim">NIM</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
								<div class="form-floating">
									<select
										class="form-select"
										id="inpSelectProdi"
										name="prodi"
										aria-label="Floating label select example">
										<option selected> - </option>
										@foreach ($prodi as $p)
											<option value="{{ $p->id }}">{{ $p->nama }}</option>
										@endforeach
									</select>
									<label for="inp-prodi">Program Studi</label>
								</div>
						</div>
						<div class="col">
							<div class="form-floating">
								<select
									class="form-select"
									id="inpSelectAkses"
									name="akses"
									aria-label="Floating label select example">
									<option  selected> - </option>
									@foreach ($akses as $a)
										<option value="{{ $a->id }}">{{ $a->nama }}</option>
									@endforeach
								</select>
								<label for="inp-status">Status</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-4 d-block">
					<div class="mb-3">
						<label for="formFile" class="form-label">Masukkan Profile</label>
						<input class="form-control" type="file" id="formFile" name="avatar">
					</div>
					<button
						type="submit"
						class="btn ms-auto btn-primary d-flex align-items-center mb-2">
						<i class="ri-add-line me-2"></i>
						<span>Tambah Anggota</span>
					</button>
				</div>
			</main>
		</form>
	</main>
@endsection
