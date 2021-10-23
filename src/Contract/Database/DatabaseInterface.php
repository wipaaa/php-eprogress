<?php

namespace Progress\Contract\Database;

interface DatabaseInterface {
	/**
	 * Bind value ke dalam query yang sudah di preparasi
	 *
	 * @param  string $_param
	 * @param  mixed $_value,
	 * @param  mixed|null $_type
	 * @return DatabaseInterface
	 */
	public function bind(
		string $_param,
		mixed $_value,
		mixed $_type = null
	): DatabaseInterface;

	/**
	 * Eksekusi query yang telah di preparasi
	 *
	 * @return  bool
	 */
	public function execute(): bool;

	/**
	 * Fetch data dari database
	 *
	 * @param   object|null $_model
	 * @return  object|bool
	 */
	public function fetch(mixed $_model = null): mixed;

	/**
	 * Fetch all data dari database
	 *
	 * @param   object|null $_model
	 * @return  array|bool
	 */
	public function fetchAll(mixed $_model = null): mixed;

	/**
	 * Menyiapkan query yang akan di eksekusi
	 *
	 * @param  string $_query
	 * @return DatabaseInterface
	 */
	public function prepare(string $_query): DatabaseInterface;
}
