<?php

namespace Progress\Contract\Router;

interface RouterInterface {
	/**
	 * String get method
	 *
	 * @var string
	 */
	public const METHOD_GET = 'GET';

	/**
	 * String post method
	 *
	 * @var string
	 */
	public const METHOD_POST = 'POST';

	/**
	 * String put method
	 *
	 * @var string
	 */
	public const METHOD_PUT = 'PUT';

	/**
	 * String delete method
	 *
	 * @var string
	 */
	public const METHOD_DELETE = 'DELETE';

	/**
	 * Mendispatch router
	 *
	 * @return void
	 */
	public function dispatch(): void;

	/**
	 * Resolve route url
	 *
	 * @param  string $_name
	 * @param  array $_args
	 * @return string
	 */
	public function resolve(string $_name, array $_args = []): string;

	/**
	 * Registrasi route dengan method get
	 *
	 * @param  string $_path
	 * @param  array $_fallback
	 * @return RouteInterface
	 */
	public function get(string $_path, array $_fallback): RouteInterface;

	/**
	 * Registrasi route dengan method post
	 *
	 * @param  string $_path
	 * @param  array $_fallback
	 * @return RouteInterface
	 */
	public function post(string $_path, array $_fallback): RouteInterface;

	/**
	 * Registrasi route dengan method put
	 *
	 * @param  string $_path
	 * @param  array $_fallback
	 * @return RouteInterface
	 */
	public function put(string $_path, array $_fallback): RouteInterface;

	/**
	 * Registrasi route dengan method delete
	 *
	 * @param  string $_path
	 * @param  array $_fallback
	 * @return RouteInterface
	 */
	public function delete(string $_path, array $_fallback): RouteInterface;
}
