<?php

namespace Progress\Contract\Http;

interface ResponseInterface {
	/**
	 * Kembali ke URL sebelumnya
	 *
	 * @param  string|null $_fallback
	 * @return ResponseInterface
	 */
	public function back(?string $_fallback = null): ResponseInterface;

	/**
	 * Redirecting halaman ke halaman baru
	 *
	 * @param  string $_url
	 * @return ResponseInterface
	 */
	public function redirect(string $_url): ResponseInterface;

	/**
	 * Memberikan respons dan mengeset session saat redirect
	 *
	 * @param  string $_name
	 * @param  mixed $_value
	 * @return ResponseInterface
	 */
	public function with(string $_name, mixed $_value): ResponseInterface;
}
