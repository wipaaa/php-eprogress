<?php

namespace Progress\Contract\Container;

interface ReflectorClassInterface {
	/**
	 * Resolve concrete class instance
	 *
	 * @param  array $_args
	 * @return object
	 */
	public function resolve(array &$_args = []): object;
}
