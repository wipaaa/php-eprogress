<?php

namespace Progress\Container\Reflector;

use Progress\Container\ContainerTrait;
use Progress\Contract\Container\ReflectorParameterInterface;
use Progress\Exception\NotFoundException;

class ReflectorParameter implements ReflectorParameterInterface {
	use ContainerTrait;

	/**
	 * ReflectionMethod class instance
	 *
	 * @var \ReflectionFunctionAbstract
	 */
	private $_reflector;

	public function __construct(\ReflectionFunctionAbstract $_reflector) {
		$this->_reflector = $_reflector;
	}

	/**
	 * @inheritdoc
	 */
	public function resolve(array &$_args = []): array
	{
		return array_map(
			function (\ReflectionParameter $_parameter) use (&$_args) {
				switch (true) {
					case $this->isDependency($_parameter):
						return $this->getDependency($_parameter);
					case $this->isOptional($_parameter):
						return $this->getOptional($_parameter);
					case $this->isRequired($_parameter):
						return $this->getRequired($_parameter);
					default:
						throw new NotFoundException(sprintf(
							"Can't resolve parameter %s at %s::%s",
							$_parameter->getName(),
							$_parameter->getDeclaringClass()->getName(),
							$_parameter->getDeclaringFunction()->getName()
						));
				}
			},
			$this->_reflector->getParameters()
		);
	}

	/**
	 * Meresolve parameter yang mengandung dependency class lain
	 *
	 * @param  \RelfectionParameter $_parameter
	 * @return object
	 */
	private function getDependency(\ReflectionParameter $_parameter): object {
		$_container = $this->getContainer();
		$_type = $_parameter->getType()->getName();

		return $_container->has($_type)
			? $_container->make($_type)
			: $_container->resolve($_type);
	}

	/**
	 * Memeriksa apakah parameter merupakan sebuah dependency class
	 *
	 * @param  \ReflectionParameter $_parameter
	 * @return bool
	 */
	private function isDependency(\ReflectionParameter $_parameter): bool {
		$_type = $_parameter->getType();

		return $_type instanceof \ReflectionNamedType && !$_type->isBuiltin();
	}

	/**
	 * Meresolve parameter default value
	 *
	 * @param  \ReflectionParameter $_parameter
	 * @return mixed
	 */
	private function getOptional(\ReflectionParameter $_parameter): mixed {
		return $_parameter->getDefaultValue();
	}

	/**
	 * Memeriksa apakah parameter merupakan default parameter
	 *
	 * @param  \ReflectionParameter $_parameter
	 * @return bool
	 */
	private function isOptional(\ReflectionParameter $_parameter): bool {
		return $_parameter->isOptional() || $_parameter->isDefaultValueAvailable();
	}

	/**
	 * Meresolve parameter yang merupakan required parameter
	 *
	 * @param  \ReflectionParameter $_parameter
	 * @param  array &$_args
	 * @return mixed
	 */
	private function getRequired(
		\ReflectionParameter $_parameter,
		array &$_args = []
	): mixed {
		$_name = $_parameter->getName();

		if (isset($_args[$_name])) {
			$_value = $_args[$_name];

			unset($_args[$_name]);
			return $_value;
		}

		return array_shift($_args);
	}

	/**
	 * Memeriksa apakah parameter merupakan required parameter
	 *
	 * @param  \ReflectionParameter $_parameter
	 * @return bool
	 */
	private function isRequired(\ReflectionParameter $_parameter): bool {
		return !$this->isOptional($_parameter);
	}
}
