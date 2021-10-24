<?php

namespace Progress\Facade;

class Database extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Database\Database::class;
	}
}
