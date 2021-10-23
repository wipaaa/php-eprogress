<?php

namespace Progress\Contract\Container;

interface ReflectorMethodInterface {
	/**
	 * Resolve method dari concrete class
	 *
	 * @param  array $_args
	 * @return mixed
	 */
	public function resolve(array &$_args = []): mixed;
}
