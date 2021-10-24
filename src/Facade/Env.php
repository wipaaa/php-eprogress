<?php

namespace Progress\Facade;

class Env extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Base\Env::class;
	}
}
