<?php

namespace App\Http\Model;

use Progress\Database\Model;

class Student {
	use Model;

	protected $_table = 'mahasiswa';

	protected $_allow = [
		'nama',
		'email',
		'phone',
		'nim',
		'prodi',
		'akses',
		'avatar'
	];
}
