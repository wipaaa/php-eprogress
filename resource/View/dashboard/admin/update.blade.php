@extends('layout.main')

@section('email', $user->email)
@section('name', $user->nama)
@section('profile', asset($user->avatar))
@section('title', 'Update Mahasiswa')

@section('content')
	<a href="{{ route('main.get.dashboard') }}">
		&larr; Back
	</a>

	<main class="mt-3">

		<form
			action="{{ route('main.put.user.update', ['id' => $student->id]) }}"
			method="POST"
			enctype="multipart/form-data">
			@method('put')
			<header><h3>Update Mahasiswa</h3></header>
			<main class="row gap-3 mt-4">
				<div class="col-3">
					<img
						src="{{ asset($student->avatar) }}"
						class="img-thumbnail rounded"
						alt="{{ $student->nim}}'s image profile"
						style="width: 250px; height: 250px; object-fit: cover;"/>
					@if ($student->id === $user->id)
						<div class="mt-3">
							<label for="formFile" class="form-label">Ganti Profile</label>
							<input class="form-control" type="file" id="formFile" name="avatar">
						</div>
					@endif
				</div>
				<div class="col">
						@method('put')
						<input type="hidden" name="_id" value="{{ $student->id }}" />
						<div class="form-floating mb-3">
							<input
								type="text"
								class="form-control"
								id="inp-nama"
								name="nama"
								value="{{ $student->nama }}"
								autocomplete="off" />
							<label for="inp-nama">Nama</label>
						</div>
						<div class="form-floating mb-3">
							<input
								type="email"
								class="form-control"
								id="inp-email"
								name="email"
								value="{{ $student->email }}"
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
										value="{{ $student->phone }}"
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
										value="{{ $student->nim }}"
										autocomplete="off"
										disabled />
									<label for="inp-nim">NIM</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								@if ($user->id === $student->id)
									<div class="form-floating mb-3">
										<input
											type="text"
											class="form-control"
											id="inp-prodi"
											name="prodi"
											value="{{ $student->prodi->nama }}"
											autocomplete="off"
											disabled />
										<label for="inp-prodi">Program Studi</label>
									</div>
								@else
									<div class="form-floating">
										<select
											class="form-select"
											id="inpSelectProdi"
											name="prodi"
											aria-label="Floating label select example">
											<option
												value="{{ $student->prodi->id }}"
												selected>
												{{ $student->prodi->nama }}
											</option>
											@foreach ($prodi as $p)
												@if ($p->id !== $student->prodi->id)
													<option value="{{ $p->id }}">{{ $p->nama }}</option>
												@endif
											@endforeach
										</select>
										<label for="inp-prodi">Program Studi</label>
									</div>
								@endif
							</div>
							<div class="col">
								@if ($user->id === $student->id)
									<div class="form-floating mb-3">
										<input
											type="text"
											class="form-control"
											id="inp-akses"
											name="akses"
											value="{{ $student->akses->nama }}"
											autocomplete="off"
											disabled />
										<label for="inp-akses">Status</label>
									</div>
								@else
									<div class="form-floating">
										<select
											class="form-select"
											id="inpSelectAkses"
											name="akses"
											aria-label="Floating label select example">
											<option
												value="{{ $student->akses->id }}"
												selected>
												{{ $student->akses->nama }}
											</option>
											@foreach ($akses as $a)
												@if ($a->id !== $student->akses->id)
													<option value="{{ $a->id }}">{{ $a->nama }}</option>
												@endif
											@endforeach
										</select>
										<label for="inp-status">Status</label>
									</div>
								@endif
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
		</form>
	</main>
@endsection
