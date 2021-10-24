<?php

namespace Progress\Facade;

use Progress\Base\Application;

abstract class Facade {
	/**
	 * Mengembalikan nama accessor dari class instance
	 *
	 * @return   string
	 */
	abstract protected static function getFacadeAccessor(): string;

	public static function __callStatic($_name, $_arguments) {
		return call_user_func_array(
			[
				Application::instance()->make(static::getFacadeAccessor()),
				$_name
			],
			$_arguments
		);
	}
}
