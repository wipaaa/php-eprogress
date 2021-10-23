<?php

namespace Progress\Contract\Http;

interface InputFileInterface {
	/**
	 * Mengembalikan nama dari file yang diinput
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Mengembalikan nama file yang diinput
	 *
	 * @return string
	 */
	public function getFilename(): string;

	/**
	 * Mengembalikan tipe file yang diinput
	 *
	 * @return string
	 */
	public function getFiletype(): string;

	/**
	 * Menyimpan file kedalam folder yang dituju
	 *
	 * @param  string $_path
	 * @param  string|null $_name
	 * @return string|null
	 */
	public function save(string $_path, ?string $_name = null);
}
