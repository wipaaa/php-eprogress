<?php

namespace Progress\View;

use Jenssegers\Blade\Blade;
use Progress\Base\Config;
use Progress\Contract\View\ViewInterface;

class View implements ViewInterface {
	/**
	 * Blade class instance
	 *
	 * @var Jenssegers\Blade\Blade
	 */
	private $_blade;

	public function __construct(Config $_config) {
		$this->_blade = new Blade(
			$_config->get('view.path'),
			$_config->get('view.cache')
		);

		$this->_blade->directive('method', function ($_expr) {
			return sprintf(
				'<input type="hidden" name="_method" value="%s" />',
				trim($_expr, '\'"')
			);
		});
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
