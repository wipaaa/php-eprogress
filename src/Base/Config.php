<?php

namespace Progress\Base;

use Progress\Contract\Base\ConfigInterface;

class Config implements ConfigInterface {
	private $_repository = [];

	public function __construct() {
		foreach (glob(PATH_CONFIG . '*.php') as $_path) {
			$_name = explode('.', basename($_path))[0];
			$this->_repository[$_name] = require $_path;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function get(string $_name, mixed $_default = null): mixed {
		return arrayGet($this->_repository, $_name, $_default);
	}

	/**
	 * @inheritdoc
	 */
	public function set(string $_name, mixed $_value): mixed {
		return arraySet($this->_repository, $_name, $_value);
	}
}
