<?php

namespace Progress\Container\Definition;

use Progress\Container\ContainerTrait;
use Progress\Contract\Container\ContainerInterface;
use Progress\Contract\Container\DefinitionAggregateInterface;
use Progress\Contract\Container\DefinitionInterface;
use Progress\Exception\NotFoundException;

class DefintionAggregate implements DefinitionAggregateInterface {
	use ContainerTrait;

	/**
	 * Kumpulan definition class
	 *
	 * @var array
	 */
	private $_definitions = [];

	public function __construct(ContainerInterface $_container) {
		$this->setContainer($_container);
	}

	/**
	 * @inheritdoc
	 */
	public function addDefinition(
		string $_name,
		mixed $_concrete
	): DefinitionInterface {
		$_definition = new Defintion($_name, $_concrete);

		$this->_definitions[] = $_definition
			->setParams([])
			->setSingleton(false);

		return $_definition;
	}

	/**
	 * @inheritdoc
	 */
	public function hasDefinition(string $_name): bool {
		foreach ($this->getIterator() as $_definition) {
			if ($_name === $_definition->getName()) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @inheritdoc
	 */
	public function makeDefinition(string $_name): object {
		$_definition = $this->getDefinition($_name);

		if ($_definition->isSingleton() && $_definition->isResolved()) {
			return $_definition->getResolved();
		}

		$_definition->setResolved(
			$this->getContainer()->resolve(
				$_definition->getConcrete(),
				$_definition->getParams()
			)
		);

		return $_definition->getResolved();
	}

	/**
	 * Resolve definition yang ada pada definitions
	 *
	 * @param  string $_name
	 * @return DefinitionInterface
	 * @throws Progress\Exception\NotFoundException
	 */
	private function getDefinition(string $_name): DefinitionInterface {
		foreach ($this->getIterator() as $_definition) {
			if ($_name === $_definition->getName()) {
				return $_definition;
			}
		}

		throw new NotFoundException(
			sprintf("Can't find definition with name %s.", $_name)
		);
	}

	/**
	 * Generator untuk setiap definition yang ada
	 *
	 * @return Generator
	 */
	private function getIterator(): \Generator {
		$_definitionsLength = count($this->_definitions);

		for ($_index = 0; $_index < $_definitionsLength; ++$_index) {
			yield $this->_definitions[$_index];
		}
	}
}
