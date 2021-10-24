<?php

use Progress\Base\Application;
use Progress\Base\Config;
use Progress\Base\Env;
use Progress\Facade\Container;
use Progress\Router\Router;
use Progress\Support\Cookie;
use Progress\Support\Session;
use Progress\View\View;

if (!function_exists('app')) {
	/**
	 * Mengembalikan Application instance class
	 *
	 * @param string|null $_name
	 * @return Progress\Base\Container|object
	 */
    function app(?string $_name = null) {
        $app = Application::instance();

        if ($_name !== null) {
            return $app->make($_name);
        }

        return $app;
    }
}

if (!function_exists('asset')) {
	/**
	 * Asset url
	 *
	 * @param  string $_name
	 * @return string
	 */
	function asset(string $_name) {
		return sprintf(
			BASE . '/public/asset/%s',
			str_replace('.', '/', $_name)
		);
	}
}

if (!function_exists('arrayForget')) {
    /**
     * Menghapus value dari sebuah array dengan notasi titik
     *
     * @param array $_array
     * @param array|string $_key
     */
    function arrayForget(array &$_array, $_key) {
        $original = &$_array;
        $_keys = (array) $_key;

        foreach ($_keys as $_key) {
            if (isset($_array[$_key])) {
                unset($_array[$_key]);
                continue;
            }

            $parts = explode('.', $_key);
            $_array = &$original;

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (!isset($_array[$part]) || !is_array($_array[$part])) {
                    continue 2;
                }

                $_array = &$_array[$part];
            }

            unset($_array[array_shift($parts)]);
        }
    }
}
if (!function_exists('arrayGet')) {
    /**
     * Mengambil value dari array dengan notasi titik
     *
     * @param array $_array
     * @param string|null $_key
     * @param mixed $default
     * @return mixed
     */
    function arrayGet(
		array $_array,
		?string $_key,
		mixed $default = null
	) {
        if ($_key === null) {
            return $_array;
        }

        if (isset($_array[$_key])) {
            return $_array[$_key];
        }

        $_keys = explode('.', $_key);

        foreach ($_keys as $_key) {
            if (!isset($_array[$_key])) {
                return $default;
            }

            $_array = $_array[$_key];
        }

        return $_array;
    }
}

if (!function_exists('arraySet')) {
    /**
     * Memasukkan value ke dalam array dengan notasi titik
     *
     * @param array $_array
     * @param string|null $_key
     * @param mixed $_value
     * @return mixed
     */
    function arraySet(array &$_array, ?string $_key, mixed $_value) {
        if ($_key === null) {
            return $_array = $_value;
        }

        $_keys = explode('.', $_key);

        while (count($_keys) > 1) {
            $_key = array_shift($_keys);

            // if the value is doesn't exists or not an array
            // let assign them with an empty array so we
            // can continue digging in and so on hehe
            if (!isset($_array[$_key]) || !is_array($_array[$_key])) {
                $_array[$_key] = [];
            }

            $_array = &$_array[$_key];
        }

        return $_array[array_shift($_keys)] = $_value;
    }
}

if (!function_exists('config')) {
	/**
	 * Meresolve data config
	 *
	 * @param  string|null $_name
	 * @param  mixed $_default
	 * @return mixed
	 */
	function config(?string $_name = null, mixed $_default = null) {
		$_config = Container::make(Config::class);

		if (is_array($_name)) {
			foreach ($_name as $_k => $_v) {
				$_config->set($_k, $_v);
			}
		} else if (is_null($_name)) {
			return $_config;
		}

		return $_config->get($_name, $_default);
	}
}

if (!function_exists('css')) {
	/**
	 * CSS url
	 *
	 * @param  string $_name
	 * @return string
	 */
	function css(string $_name) {
		return sprintf(
			BASE . '/public/css/%s.css',
			str_replace('.', '/', $_name)
		);
	}
}

if (!function_exists('cookie')) {
	/**
	 * Memanipulasi cookie
	 *
	 * @param  string|null $_name
	 * @param  mixed $_default
	 * @return mixed
	 */
	function cookie(?string $_name = null, mixed $_default = null) {
		$_cookie = Container::make(Cookie::class);

		if (is_array($_name)) {
			foreach ($_name as $_k => $_v) {
				$_cookie->set($_k, $_v);
			}
		} elseif (is_null($_name)) {
			return $_cookie;
		}

		return $_cookie->get($_name, $_default);
	}
}

if (!function_exists('env')) {
	/**
	 * Meresolve data env
	 *
	 * @param  string|null $_name
	 * @param  mixed $_default
	 * @return mixed
	 */
	function env(?string $_name = null, mixed $_default = null) {
		$_env = Container::make(Env::class);

		if (is_array($_name)) {
			foreach ($_name as $_k => $_v) {
				$_env->set($_k, $_v);
			}
		} else if (is_null($_name)) {
			return $_env;
		}

		return $_env->get($_name, $_default);
	}
}

if (!function_exists('error')) {
	/**
	 * Mengembalikan error message pada session
	 *
	 * @param  string $_name
	 * @return string
	 */
	function error(string $_name) {
		$_name = sprintf('error.%s', $_name);
		$_message = session($_name);

		session()->forget($_name);

		return $_message;
	}
}

if (!function_exists('flash')) {
	/**
	 * Mengembalikan flash message
	 *
	 * @param  string $_name
	 * @return string
	 */
	function flash(string $_name) {
		$_name = sprintf('flash.%s', $_name);
		$_message = session($_name);

		session()->forget($_name);

		return $_message;
	}
}

if (!function_exists('js')) {
	/**
	 * JS url
	 *
	 * @param  string $_name
	 * @return string
	 */
	function js(string $_name) {
		return sprintf(
			BASE . '/public/js/%s.js',
			str_replace('.', '/', $_name)
		);
	}
}

if (!function_exists('old')) {
	/**
	 * Mengembalikan old value
	 *
	 * @param  string $_name
	 * @return string
	 */
	function old(string $_name) {
		$_name = sprintf('old.%s', $_name);
		$_message = session($_name);

		session()->forget($_name);

		return $_message;
	}
}

if (!function_exists('route')) {
	/**
	 * Resolve route url
	 *
	 * @param  string $_name
	 * @param  array $_args
	 * @return string
	 */
	function route(string $_name, array $_args = []) {
		return Container::make(Router::class)->resolve($_name, $_args);
	}
}

if (!function_exists('session')) {
	/**
	 * Memanipulasi session
	 *
	 * @param  string|null $_name
	 * @param  mixed $_default
	 * @return mixed
	 */
	function session(?string $_name = null, mixed $_default = null) {
		$_session = Container::make(Session::class);

		if (is_array($_name)) {
			foreach ($_name as $_k => $_v) {
				$_session->set($_k, $_v);
			}
		} elseif (is_null($_name)) {
			return $_session;
		}

		return $_session->get($_name, $_default);
	}
}

if (!function_exists('view')) {
	/**
	 * Kompilasi view dengan standalone Blade template engine
	 *
	 * @param  string $_name
	 * @param  array $_data
	 * @return string
	 */
	function view(string $_name, array $_data = []) {
		return Container::make(View::class)->make($_name, $_data);
	}
}
