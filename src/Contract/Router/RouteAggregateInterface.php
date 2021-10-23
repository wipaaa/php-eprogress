<?php

namespace Progress\Contract\Router;

use Progress\Contract\Http\RequestInterface;

interface RouteAggregateInterface {
	/**
	 * Menambahkan route baru
	 *
	 * @return RouteAggregateInterface
	 */
	public function addRoute(
		string $_method,
		string $_path,
		array $_fallback
	): RouteInterface;

	/**
	 * Resolve defintion class yang diregister
	 *
	 * @return void
	 */
	public function dispatchRoute(): void;

	/**
	 * Resolve route url
	 *
	 * @param  string $_name
	 * @param  array $_args
	 * @return string
	 */
	public function resolveRoute(string $_name, array $_args = []): string;
}
