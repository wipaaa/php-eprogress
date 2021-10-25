@php
	if (session('flash.success')) {
		$_key = 'success';
		$_type = 'bg-success';
	} elseif (session('flash.failed')) {
		$_key = 'failed';
		$_type = 'bg-danger';
	}
@endphp

@if (count(session()->get('flash', [])) > 0)
	<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
		<div id="alertToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<div
					class="d-block {{ $_type }} rounded me-3"
					style="width: 20px; height: 20px;"></div>
				<strong class="me-auto">System</strong>
			</div>
			<div class="toast-body">
				{{ flash($_key) }}
			</div>
		</div>
	</div>
@endif

