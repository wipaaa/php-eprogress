<?php

namespace Progress\Contract\Container;

interface ContainerInterface {

	/**
	 * Binding concrete class ke dalam container
	 *
	 * @param  string $_name
	 * @param  callable|object|string|null $_concrete
	 * @return void
	 */
	public function bind(string $_name, $_concrete = null): void;

	/**
	 * Memanggil method pada concrete class di dalam container
	 *
	 * @param  string $_name
	 * @param  string $_method
	 * @param  array $_args
	 * @return mixed
	 */
	public function call(string $_name, string $_method, array $_args = []): mixed;

	/**
	 * Memeriksa apakah concrete ada di dalam container
	 *
	 * @param  string $_name
	 * @return bool
	 */
	public function has(string $_name): bool;

	/**
	 * Resolve concrete class yang di bind dalam container
	 *
	 * @param  string $_name
	 * @return object
	 */
	public function make(string $_name): object;

	/**
	 * Resolve concrete class dan mengaplikasikan autowiring dependencies
	 *
	 * @param  string $_class
	 * @param  array $_args
	 * @return object
	 */
	public function resolve(string $_class, array $_args = []): object;
}
