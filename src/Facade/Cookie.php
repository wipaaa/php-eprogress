<?php

namespace Progress\Facade;

class Cookie extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Support\Cookie::class;
	}
}
