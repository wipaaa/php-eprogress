<?php

namespace Progress\Contract\View;

interface ViewInterface {
	/**
	 * Mengcompile view dengan template engine dari standalone Laravel/Blade
	 *
	 * @param  string $_name
	 * @param  array $_data
	 * @return string
	 */
	public function make(string $_name, array $_data = []): string;
}
