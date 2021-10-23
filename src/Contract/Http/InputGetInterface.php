<?php

namespace Progress\Contract\Http;

interface InputGetInterface {
	/**
	 * Mengembalikan nama dari input $_GET
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Mengembalikan value dari input $_GET
	 *
	 * @return mixed
	 */
	public function getValue(): mixed;
}
