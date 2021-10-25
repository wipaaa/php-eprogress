<?php

namespace Progress\Router;

use Progress\Base\Application;
use Progress\Contract\Http\RequestInterface;
use Progress\Contract\Router\RouteInterface;
use Progress\Support\Session;

class Route implements RouteInterface {
	/**
	 * Data aksi dari sebuah route
	 *
	 * @var string
	 */
	private $_action;

	/**
	 * Data argumen dari sebuah route
	 *
	 * @var array
	 */
	private $_arguments = [];

	/**
	 * Data controller dari sebuah route
	 *
	 * @var string
	 */
	private $_controller;

	/**
	 * Data method dari sebuah route
	 *
	 * @var string
	 */
	private $_method;

	/**
	 * Data nama dari sebuah route
	 *
	 * @var string
	 */
	private $_name;

	/**
	 * Data parameter dari sebuah route
	 *
	 * @var array
	 */
	private $_params = [];

	/**
	 * Data path dari sebuah route
	 *
	 * @var string
	 */
	private $_path;

	/**
	 * Data regex dari sebuah route
	 *
	 * @var string
	 */
	private $_regex;

	public function __construct(string $_path) {
		$this->_path = $_path;
	}

	public function dispatch(): void {
		$_action = $this->_action;
		$_controller = $this->_controller;
		$_params = array_slice($this->_params, 1) ?: [];

		Application::instance()
			->make(Session::class)
			->set('current', $this->_path);

		echo Application::instance()->call(
			$_controller,
			$_action,
			$_params
		);
	}

	/**
	 * @inheritdoc
	 */
	public function match(RequestInterface $_request): bool {
		if ($this->_method !== strtoupper($_request->getMethod())) {
			return false;
		}

		if (preg_match(
			$this->_regex,
			$_request->getPath(),
			$this->_params
		) === 0) {
			return false;
		}

		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function resolve(array $_args): string {
		return sprintf(
			'%s%s',
			BASE,
			preg_replace_callback(
				'/(?:\/\{([^}]+\??)\})/i',
				function ($_matches) use (&$_args) {
					$_parameterName = str_replace('?', '', $_matches[1]);

					if (strpos($_matches[1], '?') !== false) {
						return sprintf('/%s', $_args[$_parameterName] ?? null);
					}

					return sprintf('/%s', $_args[$_parameterName]);
				},
				$this->_path
			)
		);
	}

	/**
	 * @inheritdoc
	 */
	public function setAction(string $_action): RouteInterface {
		$this->_action = $_action;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function setController(string $_controller): RouteInterface {
		$this->_controller = $_controller;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function setMethod(string $_method): RouteInterface {
		$this->_method = $_method;
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
	public function setName(string $_name): RouteInterface {
		$this->_name = $_name;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function setPath(string $_path): RouteInterface {
		$this->_path = $_path;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function setRegex(): RouteInterface {
		$this->_regex = preg_replace_callback(
			'/(?:\/\{([^}]+\??)\})/i',
			function ($_matches) {
				$this->_arguments[] = $_matches[1];

				if (strpos($_matches[1], '?') !== false) {
					return '(?:/([^/]+?))?';
				}

				return '/(?:([^/]+?))';
			},
			rtrim($this->_path, '/')
		);

		$this->_regex = sprintf(
			'/^%s\/?$/i',
			str_replace('/', '\/', $this->_regex)
		);

		return $this;
	}
}
