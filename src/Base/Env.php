<?php

namespace Progress\Base;

use Dotenv\Dotenv;
use Progress\Contract\Base\EnvInterface;

class Env implements EnvInterface {
	public function __construct() {
		$_dotenv = Dotenv::createImmutable(ROOT);
		$_dotenv->load();
	}

	/**
	 * @inheritdoc
	 */
	public function get(string $_name, mixed $_default = null): mixed {
		return arrayGet($_ENV, $_name, $_default);
	}

	/**
	 * @inheritdoc
	 */
	public function set(string $_name, mixed $_value): mixed {
		return arraySet($_ENV, $_name, $_value);
	}
}
