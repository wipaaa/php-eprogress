<?php

namespace Progress\View;

use Jenssegers\Blade\Blade;
use Progress\Base\Config;
use Progress\Contract\View\ViewInterface;

class View implements ViewInterface {
	private $_blade;

	public function __construct(Config $_config) {
		$this->_blade = new Blade(
			$_config->get('view.path'),
			$_config->get('view.cache')
		);
	}

	/**
	 * @inheritdoc
	 */
	public function make(string $_name, array $_data = []): string {
		return $this->_blade->make(
			$_name,
			$_data
		)->render();
	}
}
