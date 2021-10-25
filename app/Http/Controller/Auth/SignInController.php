<?php

namespace App\Http\Controller\Auth;

use App\Http\Model\Student;
use Progress\Http\Request;
use Progress\Http\Response;

class SignInController {
	public function __construct(Response $_response) {
		if (session('prefetch')) {
			return $_response->redirect(route('main.get.dashboard'));
		}
	}

	public function index() {
		return view('auth.signin', [
			'title' => 'Sign In'
		]);
	}

	public function store(Request $_request, Response $_response) {
		$_user = Student::find($_request->getInput('nim')->getValue(), 'nim');

		if (!$_user) {
			return $_response
				->with('error.nim', 'NIM tidak terdaftar!')
				->back();
		}

		if ($_user->password !== $_request->getInput('password')->getValue()) {
			return $_response
				->with('error.password', 'Password salah!')
				->back();
		}

		session()->flush();

		return $_response
			->with('prefetch', $_user->id)
			->redirect(route('main.get.dashboard'));
	}
}
