<?php

namespace App\Http\Controller\Main;

use App\Http\Model\Student;
use App\Http\Model\Program;
use App\Http\Model\Role;
use Progress\Http\Response;

class DashboardController {
	public function __construct(Response $_response) {
		if (!session('prefetch', false)) {
			return $_response->redirect(route('auth.get.signin'));
		}
	}

	public function indexMain() {
		$_user = Student::find(session('prefetch'));

		return view('dashboard.main', [
			'user' => $_user,
			'users' => $_user->akses === '1' ? Student::all() : []
		]);
	}

	public function indexProfile() {
		$_user = Student::find(session('prefetch'));

		$_user->akses = Role::find($_user->akses);
		$_user->prodi = Program::find($_user->prodi);

		return view('dashboard.user.profile', [
			'user' => $_user
		]);
	}

	public function indexCreate() {
		$_user = Student::find(session('prefetch'));

		$_akses = Role::all();
		$_prodi = Program::all();

		$_user->akses = Role::find($_user->akses);
		$_user->prodi = Program::find($_user->prodi);

		return view('dashboard.admin.create', [
			'akses' => $_akses,
			'prodi' => $_prodi,
			'user' => $_user
		]);
	}
}
