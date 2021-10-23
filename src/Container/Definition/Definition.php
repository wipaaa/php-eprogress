<?php

namespace Progress\Container\Definition;

use Progress\Contract\Container\DefinitionInterface;

class Definition implements DefinitionInterface {
	/**
	 * Nama dari stored concrete class
	 *
	 * @var string
	 */
	private $_name;

	/**
	 * Stored concrete class
	 *
	 * @var callable|object|string
	 */
	private $_concrete;

	/**
	 * Parameter dari stored concrete class
	 *
	 * @var array
	 */
	private $_params = [];

	/**
	 * Resolved stored concrete class
	 *
	 * @var object
	 */
	private $_resolved;

	/**
	 * Kondisi singleton dari sebuah resolved stored concrete class
	 *
	 * @var bool
	 */
	private $_singleton;

	public function __construct(string $_name, $_concrete)
	{
		$this->_name = $_name;
		$this->_concrete = $_concrete;
	}

	/**
	 * @inheritdoc
	 */
	public function getConcrete(): mixed {
		return $this->_concrete;
	}

	/**
     * @inheritDoc
     */
    public function setConcrete($_concrete): DefinitionInterface {
        $this->_concrete= $_concrete;
        return $this;
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
	public function setName(string $_name): DefinitionInterface {
		$this->name = $_name;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getParams(): array {
		return $this->_params;
	}

	/**
	 * @inheritdoc
	 */
	public function setParams(array $_params): DefinitionInterface {
		$this->_params = $_params;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getResolved(): object {
		return $this->_resolved;
	}

	/**
	 * @inheritdoc
	 */
	public function isResolved(): bool {
		return $this->_resolved !== null;
	}

	/**
	 * @inheritdoc
	 */
	public function setResolved(object $_concrete): DefinitionInterface	{
		$this->_resolved = $_concrete;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function isSingleton(): bool	{
		return $this->_singleton !== null && $this->_singleton === true;
	}

	/**
	 * @inheritdoc
	 */
	public function setSingleton(bool $_singleton): DefinitionInterface {
		$this->_singleton = $_singleton;
		return $this;
	}
}
