<?php

namespace Progress\Base;

use Progress\Container\Container;
use Progress\Database\Database;
use Progress\Http\Input;
use Progress\Http\Request;
use Progress\Http\Response;
use Progress\Router\Router;
use Progress\Support\Cookie;
use Progress\Support\Session;
use Progress\View\View;

class Application {
	/**
	 * Self class instance
	 *
	 * @var Progress\Base\Application
	 */
	private static $_instance;

	/**
	 * Container class instance
	 *
	 * @var Progress\Container\Container
	 */
	private $_container;

	public function __construct() {
		self::$_instance = $this;

		define('BASE', 'http://localhost/progress');
		define('DS', DIRECTORY_SEPARATOR);
		define('ROOT', dirname(__DIR__, 2) . DS);
		define('PATH_APP', realpath(ROOT . 'app') . DS);
		define('PATH_CONFIG', realpath(ROOT . 'config') . DS);
		define('PATH_LIB', realpath(ROOT . 'src') . DS);
		define('PATH_PUBLIC', realpath(ROOT . 'public') . DS);
		define('PATH_RESOURCE', realpath(ROOT . 'resource') . DS);
		define('PATH_ROUTER', realpath(ROOT . 'router') . DS);

		$this->_container = new Container();

		$this->_container->bind(Application::class)
			->setResolved($this)
			->setSingleton(true);

		$this->_container->bind(Container::class)
			->setResolved($this->_container)
			->setSingleton(true);

		$this->_container->bind(Config::class)->setSingleton(true);
		$this->_container->bind(Cookie::class)->setSingleton(true);
		$this->_container->bind(Database::class)->setSingleton(true);
		$this->_container->bind(Router::class)->setSingleton(true);
		$this->_container->bind(Session::class)->setSingleton(true);
		$this->_container->bind(View::class)->setSingleton(true);

		$this->_container->bind(Input::class);
		$this->_container->bind(Request::class);
		$this->_container->bind(Response::class);

		$this->_container->make(Router::class)->dispatch();
	}

	/**
	 * Memakai class application secara static
	 *
	 * @return Progress\Container\Container
	 */
	public static function instance() {
		return self::$_instance->_container;
	}
}
