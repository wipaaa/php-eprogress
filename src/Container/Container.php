<?php

namespace Progress\Container;

use Progress\Container\Definition\DefintionAggregate;
use Progress\Container\Reflector\ReflectorClass;
use Progress\Container\Reflector\ReflectorMethod;
use Progress\Contract\Container\ContainerInterface;
use Progress\Contract\Container\DefinitionInterface;

class Container implements ContainerInterface {
	/**
	 * DefinitionAggregate class instance
	 *
	 * @var Progress\Contract\Container\DefinitionAggregateInterface
	 */
	private $_definitions;

	public function __construct() {
		$this->_definitions = new DefintionAggregate($this);
	}

	/**
	 * @inheritdoc
	 */
	public function bind(string $_name, $_concrete = null): DefinitionInterface {
		return $this->_definitions->addDefinition(
			$_name,
			$_concrete ?? $_name
		);
	}

	/**
	 * @inheritdoc
	 */
	public function call(
		string $_name,
		string $_method,
		array $_args = []
	): mixed {
		$_class = $this->has($_name)
			? $this->make($_name)
			: $this->resolve($_name);

		$_reflector = new ReflectorMethod($_class, $_method);

		return $_reflector
			->setContainer($this)
			->resolve($_args);
	}

	/**
	 * @inheritdoc
	 */
	public function has(string $_name): bool {
		return $this->_definitions->hasDefinition($_name);
	}

	/**
	 * @inheritdoc
	 */
	public function make(string $_name): object {
		return $this->_definitions->makeDefinition($_name);
	}

	/**
	 * @inheritdoc
	 */
	public function resolve(mixed $_class, array $_args = []): object
	{
		$_reflector = new ReflectorClass($_class);

		return $_reflector
			->setContainer($this)
			->resolve($_args);
	}
}
