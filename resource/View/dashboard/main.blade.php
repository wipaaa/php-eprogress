@extends('layout.main')

@section('email', $user->email)
@section('name', $user->nama)
@section('profile', asset($user->avatar))
@section('title', 'Dashboard')

@section('content')
	@if ($user->akses === '1')
		@include('dashboard.admin.main')
	@else
		<h3>Hai, {{ $user->nama }}</h3>
	@endif
@endsection
