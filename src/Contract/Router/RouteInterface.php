<?php

namespace Progress\Contract\Router;

use Progress\Contract\Http\RequestInterface;

interface RouteInterface {
	/**
	 * Mendispatch route
	 *
	 * @return void
	 */
	public function dispatch(): void;

	/**
	 * Memeriksa apakah url pada route sudah sama dengan requested url
	 *
	 * @param  RequestInterface $_request
	 * @return bool
	 */
	public function match(RequestInterface $_request): bool;

	/**
	 * Resolve url
	 *
	 * @param  array $_args
	 * @return string
	 */
	public function resolve(array $_args): string;

	/**
	 * Mengeset aksi dari sebuah route
	 *
	 * @param  string $_action
	 * @return RouteInterface
	 */
	public function setAction(string $_action): RouteInterface;

	/**
	 * Mengeset controller dari sebuah route
	 *
	 * @param  string $_controller
	 * @return RouteInterface
	 */
	public function setController(string $_controller): RouteInterface;

	/**
	 * Mengeset method dari sebuah route
	 *
	 * @param  string $_method
	 * @return RouteInterface
	 */
	public function setMethod(string $_method): RouteInterface;

	/**
	 * Mengembalikan nama dari sebuah route
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Mengeset nama dari sebuah route
	 *
	 * @param  string $_name
	 * @return RouteInterface
	 */
	public function setName(string $_name): RouteInterface;

	/**
	 * Mengeset path dari sebuah route
	 *
	 * @param  string $_path
	 * @return RouteInterface
	 */
	public function setPath(string $_path): RouteInterface;

	/**
	 * Mengeset regex dari sebuah route
	 *
	 * @return RouteInterface
	 */
	public function setRegex(): RouteInterface;
}
