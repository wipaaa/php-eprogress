<?php

namespace Progress\Facade;

class Response extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Http\Response::class;
	}
}
