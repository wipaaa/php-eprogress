<?php

namespace Progress\Container;

use Progress\Contract\Container\ContainerInterface;
use Progress\Exception\ContainerException;

trait ContainerTrait {
	/**
	 * Container class instance
	 *
	 * @var Progress\Contract\Container\ContainerInterface
	 */
	protected $_container;

	/**
	 * Mengembalikan container class instance
	 *
	 * @return object
	 * @throws Progress\Exception\ContainerException
	 */
	public function getContainer() {
		if ($this->_container !== null) {
			return $this->_container;
		}

		throw new ContainerException(
			sprintf("Container instance is unresolved.")
		);
	}

	/**
	 * Mengeset container class instance
	 *
	 * @param  Progress\Contract\Container\ContainerInterface $_container
	 * @return self
	 */
	public function setContainer(ContainerInterface $_container): self {
		$this->_container = $_container;
		return $this;
	}
}
