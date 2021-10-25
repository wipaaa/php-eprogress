<?php

namespace Progress\Contract\Support;

interface SessionInterface {
	/**
	 * Mengembalikan seluruh nilai session
	 *
	 * @return array
	 */
	public function all(): array;

	/**
	 * Clear semua data session
	 *
	 * @return void
	 */
	public function flush(): void;

	/**
	 * Menghapus data dari session
	 *
	 * @param  string $_name
	 * @return void
	 */
	public function forget(string $_name);

	/**
	 * Mengembalikan nilai session berdasarkan nama yang dipilih
	 *
	 * @param  string $_name
	 * @param  mixed $_default
	 * @return mixed
	 */
	public function get(string $_name, mixed $_default = null): mixed;

	/**
	 * Memeriksa apakah data session ada
	 *
	 * @param  string $_name
	 * @return bool
	 */
	public function has(string $_name): bool;

	/**
	 * Regenerasi session baru
	 *
	 * @return bool
	 */
	public function regenerate(): bool;

	/**
	 * Memasukkan nilai baru ke dalam session
	 *
	 * @param  string $_name
	 * @param  mixed $_value
	 * @return mixed
	 */
	public function set(string $_name, mixed $_value): mixed;
}
