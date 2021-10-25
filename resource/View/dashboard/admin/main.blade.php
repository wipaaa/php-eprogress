<div class="row">
	<div class="col-8">
		<header>
			<h3>Anggota Progress</h3>
		</header>
		<main class="py-3">
			<span data-js="{{ json_encode($users) }}"></span>
			@foreach ($users as $u)
				<div
					class="text-dark text-decoration-none">
					<div class="d-flex align-items-center justify-content-between mb-3 px-2 py-2 border rounded">
						<div class="d-flex align-items-center">
							<img
								src="{{ asset($u->avatar) }}"
								class="img-fluid rounded me-3"
								alt="{{ $u->nim}}'s image profile"
								style="width: 30px; height: 30px; object-fit: cover;"/>
							<div>
								{{ $u->nama }}
								-
								<span class="text-muted">{{ $u->nim }}</span>
								@if ($u->akses === '1')
									-
									<span class="text-primary">Administrator</span>
								@endif
							</div>
						</div>
						<div class="d-flex align-items-center justify-content-end gap-1">
							<a
								href="{{ route('main.get.user.details', ['id' => $u->id]) }}"
								class="btn btn-sm btn-primary d-flex align-items-center"
								data-bs-toggle="tooltip"
								data-bs-placement="top"
								title="Lihat detail anggota">
								<i class="ri-eye-line"></i>
							</a>
							<a
								href="{{ route('main.get.user.update', ['id' => $u->id]) }}"
								class="btn btn-sm btn-warning d-flex align-items-center text-light"
								data-bs-toggle="tooltip"
								data-bs-placement="top"
								title="Update biodata anggota">
								<i class="ri-pencil-line"></i>
							</a>
							@if ($u->id === session('prefetch'))
								<a
									href="{{ route('main.get.user.update', ['id' => $u->id]) }}"
									class="btn btn-sm btn-dark d-flex align-items-center text-light"
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									title="Update password anggota">
									<i class="ri-lock-line"></i>
								</a>
							@endif
							@if ($u->id !== $user->id)
								<a
									href="{{ route('main.get.user.delete', ['id' => $u->id]) }}"
									class="btn btn-sm btn-danger d-flex align-items-center"
									data-bs-toggle="tooltip"
									data-bs-placement="top"
									title="Hapus anggota">
									<i class="ri-delete-bin-line"></i>
								</a>
							@endif
						</div>
					</div>
				</div>
			@endforeach
		</main>
	</div>
	<div class="col-3 py-5">
		<a
			href="{{ route('main.get.create') }}"
			class="btn btn-primary d-flex align-items-center my-2">
			<i class="ri-add-line me-2"></i>
			<span>Tambah Anggota</span>
		</a>
		<div class="d-block border rounded px-3 pt-2 pb-0">
			<div class="d-flex align-items-center">
				<i class="ri-group-line me-2"></i>
				<small class="text-muted">
					<span>Jumlah Anggota</span>
				</small>
			</div>
			<div class="d-flex align-items-center">
				<h2>{{ count($users) }}</h2>
			</div>
		</div>
	</div>
</div>
