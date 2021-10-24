<?php

namespace Progress\Facade;

class View extends Facade {
	/**
	 * @inheritdoc
	 */
	protected static function getFacadeAccessor(): string {
		return \Progress\View\View::class;
	}
}
