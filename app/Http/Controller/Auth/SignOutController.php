<?php

namespace App\Http\Controller\Auth;

use Progress\Facade\Response;

class SignOutController {
	public function index() {
		session()->flush();
		return Response::redirect(route('auth.get.signin'));
	}
}
