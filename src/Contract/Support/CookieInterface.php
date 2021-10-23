<?php

namespace Progress\Contract\Support;

interface CookieInterface {
	/**
	 * Mengembalikan seluruh nilai cookie
	 *
	 * @return array
	 */
	public function all(): array;

	/**
	 * Clear semua data cookie
	 *
	 * @return void
	 */
	public function flush(): void;

	/**
	 * Menghapus data dari cookie
	 *
	 * @param  string $_name
	 * @return void
	 */
	public function forget(string $_name);

	/**
	 * Mengembalikan nilai cookie berdasarkan nama yang dipilih
	 *
	 * @param  string $_name
	 * @param  string|null $_default
	 * @return mixed
	 */
	public function get(string $_name, ?string $_default = null): mixed;

	/**
	 * Memeriksa apakah data cookie ada
	 *
	 * @param  string $_name
	 * @return bool
	 */
	public function has(string $_name): bool;

	/**
	 * Memasukkan nilai baru ke dalam cookie
	 *
	 * @param  string $_name
	 * @param  mixed $_value
	 * @return mixed
	 */
	public function set(string $_name, mixed $_value): mixed;
}
