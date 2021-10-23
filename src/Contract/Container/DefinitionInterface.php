<?php

namespace Progress\Contract\Container;

interface DefinitionInterface {
	/**
	 * Mengembalikan stored concrete class
	 *
	 * @return mixed
	 */
	public function getConcrete(): mixed;

	/**
	 * Mengeset concrete class
	 *
	 * @param  mixed $_concrete
	 * @return DefinitionInterface
	 */
	public function setConcrete($_concrete): DefinitionInterface;

	/**
	 * Mengembalikan nama dari concrete class
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Mengeset nama untuk concrete class
	 *
	 * @param  string $_name
	 * @return DefinitionInterface
	 */
	public function setName(string $_name): DefinitionInterface;

	/**
	 * Mengembalikan parameter dari stored concrete class
	 *
	 * @return array
	 */
	public function getParams(): array;

	/**
	 * Mengeset paramater untuk stored concrete class
	 *
	 * @param  array $_params
	 * @return DefinitionInterface
	 */
	public function setParams(array $_params): DefinitionInterface;

	/**
	 * Mengembalikan resolved concrete class
	 *
	 * @return object
	 */
	public function getResolved(): object;

	/**
	 * Memeriksa apakah stored concrete class sudah diresolve
	 *
	 * @return bool
	 */
	public function isResolved(): bool;

	/**
	 * Mengeset resolved concrete class
	 *
	 * @param  mixed $_concrete
	 * @return DefinitionInterface
	 */
	public function setResolved(object $_concrete): DefinitionInterface;

	/**
	 * Memeriksa apakah stored concrete class merupakan singleton
	 *
	 * @return bool
	 */
	public function isSingleton(): bool;

	/**
	 * Mengeset apakah stored concrete class merupakan singleton
	 *
	 * @param  bool $_singleton
	 * @return DefinitionInterface
	 */
	public function setSingleton(bool $_singleton): DefinitionInterface;
}
