<?php

namespace Progress\Http\Input;

use Progress\Contract\Http\InputGetInterface;

class InputGet implements InputGetInterface {
	/**
	 * Nama dari input $_GET
	 *
	 * @var string
	 */
	private $_name;

	/**
	 * Value dari input $_GET
	 *
	 * @var mixed
	 */
	private $_value;

	public function __construct($_name, $_value)
	{
		$this->_name = $_name;
		$this->_value = $_value;
	}

	/**
	 * @inheritdoc
	 */
	public function getName(): string {
		return $this->_name;
	}

	/**
	 * @inheritdoc
	 */
	public function getValue(): mixed {
		return $this->_value;
	}

	public function __toString() {
		return $this->_value;
	}
}
