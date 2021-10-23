<?php

namespace Progress\Router;

use Progress\Contract\Http\RequestInterface;
use Progress\Contract\Router\RouteAggregateInterface;
use Progress\Contract\Router\RouteInterface;

class RouteAggregate implements RouteAggregateInterface {
	private $_request;
	private $_routes = [];

	public function __construct(RequestInterface $_request) {
		$this->_request = $_request;
	}

	public function addRoute(
		string $_method,
		string $_path,
		array $_fallback
	): RouteInterface {
		$_route = new Route($_path);

		$this->_routes[] = $_route
			->setAction($_fallback[1])
			->setController($_fallback[0])
			->setMethod($_method)
			->setPath($_path)
			->setRegex();

		return $_route;
	}

	/**
	 * @inheritdoc
	 */
	public function dispatchRoute(): void {
		require realpath(PATH_ROUTER . 'web.php');

		foreach ($this->getIterator() as $_route) {
			if ($_route->match($this->_request)) {
				$_route->dispatch($this->_request);
				break;
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function resolveRoute(string $_name, array $_args = []): string {
		foreach ($this->getIterator() as $_route) {
			if ($_name === $_route->getName()) {
				return $_route->resolve($_args);
			}
		}
	}

	/**
	 * Generator route
	 *
	 * @return Generator
	 */
	private function getIterator(): \Generator {
		$_routesLength = count($this->_routes);

		for ($_index = 0; $_index < $_routesLength; ++$_index) {
			yield $this->_routes[$_index];
		}
	}
}
