<?php

namespace Progress\Container\Reflector;

use Progress\Container\ContainerTrait;
use Progress\Contract\Container\ReflectorMethodInterface;

class ReflectorMethod implements ReflectorMethodInterface {
	use ContainerTrait;

	/**
	 * ReflectionMethod class instance
	 *
	 * @var \ReflectionMethod
	 */
	private $_reflector;

	public function __construct(mixed $_class, string $_method) {
		$this->_reflector = new \ReflectionMethod($_class, $_method);
	}

	/**
	 * @inheritdoc
	 */
	public function resolve(array &$_args = []): mixed {
		$_container = $this->getContainer();
		$_className = $this->_reflector->getDeclaringClass()->getName();
		$_dependencies = (new ReflectorParameter($this->_reflector))
			->setContainer($_container)
			->resolve($_args);

		$_class = $_container->has($_className)
			? $_container->make($_className)
			: $_container->resolve($_className);

		return $this->_reflector->invokeArgs(
			$_class,
			$_dependencies
		);
	}
}
