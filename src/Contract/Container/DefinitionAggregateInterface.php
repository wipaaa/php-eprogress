<?php

namespace Progress\Contract\Container;

interface DefinitionAggregateInterface {
	/**
	 * Menambahkan definition class baru
	 *
	 * @param  string $_name
	 * @param  callable|object|string $_concrete
	 * @return DefinitionInterface
	 */
	public function addDefinition(string $_name, mixed $_concrete): DefinitionInterface;

	/**
	 * Memeriksa apakah definition class sudah diregister
	 *
	 * @param  string $_name
	 * @return bool
	 */
	public function hasDefinition(string $_name): bool;

	/**
	 * Resolve defintion class yang diregister
	 *
	 * @param  string $_name
	 * @return object
	 */
	public function makeDefinition(string $_name): object;
}
