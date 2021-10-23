<?php

namespace Progress\Contract\Http;

interface InputInterface {
	/**
	 * Mengembalikan $_FILE data
	 *
	 * @param  string $_name
	 * @return InputFileInterface|mixed
	 */
	public function file(string  $_name): mixed;

	/**
	 * Mengembalikan $_GET data
	 *
	 * @param  string $_name
	 * @param  mixed $_default
	 * @return InputGetInterface|mixed
	 */
	public function get(string $_name, mixed $_default = null): mixed;

	/**
	 * Mengembalikan $_POST data
	 *
	 * @param  string $_name
	 * @param  mixed $_default
	 * @return InputPostInterface|mixed
	 */
	public function post(string $_name, mixed $_default = null): mixed;
}
