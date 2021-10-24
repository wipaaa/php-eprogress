<?php

namespace Progress\Facade;

class Input extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\Http\Input::class;
	}
}
