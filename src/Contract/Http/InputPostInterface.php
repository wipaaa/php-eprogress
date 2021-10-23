<?php

namespace Progress\Contract\Http;

interface InputPostInterface {
	/**
	 * Mengembalikan nama dari input $_POST
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Mengembalikan value dari input $_POST
	 *
	 * @return mixed
	 */
	public function getValue(): mixed;
}
