<?php

namespace Progress\Facade;

class Request extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Http\Request::class;
	}
}
