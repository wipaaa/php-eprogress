<?php

namespace Progress\Contract\Base;

interface EnvInterface {
	/**
	 * Meresolve data env
	 *
	 * @param  string $_name
	 * @param  mixed|null $_default
	 * @return mixed
	 */
	public function get(string $_name, mixed $_default = null): mixed;

	/**
	 * Memasukan data env kedalam env repository
	 *
	 * @param  string $_name
	 * @param  mixed $_value
	 * @return mixed
	 */
	public function set(string $_name, mixed $_value): mixed;
}
