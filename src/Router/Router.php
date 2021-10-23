<?php

namespace Progress\Router;

use Progress\Contract\Router\RouteInterface;
use Progress\Contract\Router\RouterInterface;
use Progress\Http\Request;

class Router implements RouterInterface {
	/**
	 * Request class instance
	 *
	 * @var Progress\Contract\Http\RequestInterface
	 */
	private $_request;

	/**
	 * RouteAggregate class instance
	 *
	 * @var Progress\Contract\Router\RouteAggregateInterface
	 */
	private $_routes;

	public function __construct(Request $_request) {
		$this->_request = $_request;
		$this->_routes = new RouteAggregate($this->_request);
	}

	/**
	 * @inheritdoc
	 */
	public function delete(string $_path, array $_fallback): RouteInterface {
		return $this->_routes->addRoute(
			self::METHOD_DELETE,
			$_path,
			$_fallback
		);
	}

	/**
	 * @inheritdoc
	 */
	public function dispatch(): void {
		$this->_routes->dispatchRoute();
	}

	/**
	 * @inheritdoc
	 */
	public function get(string $_path, array $_fallback): RouteInterface {
		return $this->_routes->addRoute(
			self::METHOD_GET,
			$_path,
			$_fallback
		);
	}

	/**
	 * @inheritdoc
	 */
	public function post(string $_path, array $_fallback): RouteInterface {
		return $this->_routes->addRoute(
			self::METHOD_POST,
			$_path,
			$_fallback
		);
	}

	/**
	 * @inheritdoc
	 */
	public function put(string $_path, array $_fallback): RouteInterface {
		return $this->_routes->addRoute(
			self::METHOD_PUT,
			$_path,
			$_fallback
		);
	}

	/**
	 * @inheritdoc
	 */
	public function resolve(string $_name, array $_args = []): string {
		return $this->_routes->resolveRoute($_name, $_args);
	}
}
