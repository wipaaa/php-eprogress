<?php

namespace Progress\Container\Reflector;

use Progress\Container\ContainerTrait;
use Progress\Contract\Container\ReflectorClassInterface;

class ReflectorClass implements ReflectorClassInterface {
	use ContainerTrait;

	/**
	 * ReflectionClass class instance
	 *
	 * @var \ReflectionClass
	 */
	private $_reflector;

	public function __construct($_class) {
		$this->_reflector = new \ReflectionClass($_class);
	}

	/**
	 * @inheritdoc
	 */
	public function resolve(array &$_args = []): object {
		if ($this->_reflector->hasMethod('__construct')) {
			return $this->_reflector->newInstanceArgs([]);
		}

		return $this->_reflector->newInstanceArgs(
			$this->resolveDependencies(
				$this->_reflector->getConstructor(),
				$_args
			)
		);
	}

	private function resolveDependencies(
		\ReflectionMethod $_constructor,
		array &$_args = []
	): array {
		$_dependencies = new ReflectorParameter($_constructor);

		return $_dependencies
			->setContainer($this->getContainer())
			->resolve($_args);
	}
}
