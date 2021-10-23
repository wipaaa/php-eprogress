<?php

namespace Progress\Support;

use Progress\Contract\Support\CookieInterface;

class Cookie implements CookieInterface {
	private $_repository = [];

	public function __construct() {
		$this->_repository = &$_COOKIE;
	}

	/**
	 * @inheritdoc
	 */
	public function all(): array {
		return $this->_repository;
	}

	/**
	 * @inheritdoc
	 */
	public function flush(): void {
		$this->_repository = [];
	}

	/**
	 * @inheritdoc
	 */
	public function forget(string $_name) {
		return arrayForget($this->_repository, $_name);
	}

	/**
	 * @inheritdoc
	 */
	public function get(string $_name, ?string $_default = null): mixed {
		return arrayGet($this->_repository, $_name, $_default);
	}

	/**
	 * @inheritdoc
	 */
	public function has(string $_name): bool {
		$_array = $this->_repository;
		$_names = (array) $_name;

		foreach ($_names as $_name) {
			$_subArray = $_array;
			$_segments = explode('.', $_name);

			foreach ($_segments as $_segment) {
				if (!isset($_subArray[$_segment])) {
					return false;
				}

				$_subArray = $_subArray[$_segment];
			}
		}

		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function set(string $_name, mixed $_value): mixed {
		return arraySet($this->_repository, $_name, $_value);
	}
}
