<?php

namespace App\Http\Controller\Main;

use App\Http\Model\Student;
use App\Http\Model\Program;
use App\Http\Model\Role;
use Progress\Http\Request;
use Progress\Http\Response;

class StudentController {
	public function indexDetails($id) {
		$_user = Student::find(session('prefetch'));
		$_student = Student::find($id);

		$_student->akses = Role::find($_student->akses);
		$_student->prodi = Program::find($_student->prodi);

		return view('dashboard.admin.details', [
			'user' => $_user,
			'student' => $_student
		]);
	}

	public function indexUpdate($id) {
		$_user = Student::find(session('prefetch'));
		$_student = Student::find($id);
		$_prodi = Program::all();
		$_akses = Role::all();

		$_student->akses = Role::find($_student->akses);
		$_student->prodi = Program::find($_student->prodi);

		return view('dashboard.admin.update', [
			'akses' => $_akses,
			'prodi' => $_prodi,
			'student' => $_student,
			'user' => $_user,
		]);
	}

	public function store(Request $_request, Response $_response) {
		$_user = new Student;
		$_file = $_request->getFile('avatar');

		$_user->nama = $_request->getInput('nama');
		$_user->email = $_request->getInput('email');
		$_user->phone = $_request->getInput('phone');
		$_user->nim = $_request->getInput('nim');
		$_user->prodi = $_request->getInput('prodi');
		$_user->akses = $_request->getInput('akses');

		if (!$_file) {
			$_user->avatar = 'https://dummyimage.com/400x400/645cff/fff.png&text=+';
		} else {
			$_path = realpath(PATH_PUBLIC . 'asset/profile/' . $_user->nim . '.jpg');

			if (file_exists($_path)) {
				unlink($_path);
			}

			$_file->save(
				realpath(PATH_PUBLIC . 'asset/profile'),
				$_user->nim
			);

			$_user->avatar = "profile/{$_user->nim}.jpg";
		}

		if (!$_user->create()) {
			return $_response
				->with('flash.failed', 'Gagal menambahkan anggota!')
				->redirect(route('main.get.dashboard'));
		}

		return $_response
			->with('flash.success', 'Berhasil menambahkan anggota!')
			->redirect(route('main.get.dashboard'));
	}

	public function update(Request $_request, Response $_response, $id) {
		$_user = Student::find($id);
		$_input = $_request->getInput('*');
		$_file = $_request->getFile('avatar');

		$_user->nama = $_input[2]->getValue();
		$_user->email = $_input[3]->getValue();
		$_user->phone = $_input[4]->getValue();
		$_user->prodi = $_input[5]->getValue();
		$_user->akses = $_input[6]->getValue();

		if ($_file) {
			$_path = realpath(PATH_PUBLIC . 'asset/profile/' . $_user->nim . '.jpg');

			if (file_exists($_path)) {
				unlink($_path);
			}

			$_file->save(
				realpath(PATH_PUBLIC . 'asset/profile'),
				$_user->nim
			);

			$_user->avatar = "profile/{$_user->nim}.jpg";
		}

		if (!$_user->save()) {
			return $_response
				->with('flash.failed', "Gagal mengupdate biodata anggota!")
				->back();
		}

		return $_response
			->with('flash.success', 'Berhasil mengupdate biodata anggota!')
			->redirect(route(
				'main.get.user.details',
				['id' => $id]
			));
	}

	public function destroy(Response $_response, $id) {
		$_user = Student::find($id);
		$_path = realpath(PATH_PUBLIC . 'asset/profile/' . $_user->nim . '.jpg');

		if (file_exists($_path)) {
			unlink($_path);
		}

		if (!Student::delete($id)) {
			return $_response
				->with('flash.failed', 'Gagal menghapus anggota!')
				->redirect(route('main.get.dashboard'));
		}

		return $_response
			->with('flash.success', 'Berhasil menghapus anggota!')
			->redirect(route('main.get.dashboard'));
	}
}
