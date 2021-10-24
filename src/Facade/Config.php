<?php

namespace Progress\Facade;

class Config extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Base\Config::class;
	}
}
