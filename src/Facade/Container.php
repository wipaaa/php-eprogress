<?php

namespace Progress\Facade;

class Container extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Container\Container::class;
	}
}
