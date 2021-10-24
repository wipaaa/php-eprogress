<?php

namespace Progress\Facade;

class Session extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Support\Session::class;
	}
}
