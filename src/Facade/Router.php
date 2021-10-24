<?php

namespace Progress\Facade;

class Router extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Router\Router::class;
	}
}
