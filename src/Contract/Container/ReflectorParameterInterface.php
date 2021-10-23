<?php

namespace Progress\Contract\Container;

interface ReflectorParameterInterface {
	/**
	 * Resolve parameter dari concrete class
	 *
	 * @param  array $_args
	 * @return object
	 */
	public function resolve(array &$_args = []): object;
}
