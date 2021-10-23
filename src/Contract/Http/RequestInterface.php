<?php

namespace Progress\Contract\Http;

interface RequestInterface {
	/**
	 * Mengembalikan nilai file request
	 *
	 * @param  string $_name
	 * @return Progress\Contract\Http\InputFileInterface|mixed
	 */
	public function getFile(string $_name): mixed;

	/**
	 * Mengembalikan request header
	 *
	 * @param  string $_name
	 * @param  mixed|null $_default
	 * @return string|null
	 */
	public function getHeader(string $_name, mixed $_default = null): ?string;

	/**
	 * Mengeset request header
	 *
	 * @param  string $_name
	 * @param  string|null $_value
	 * @return RequestInterface
	 */
	public function setHeader(string $_name, ?string $_value = null): RequestInterface;

	/**
	 * Mengembalikan nilai input
	 *
	 * @param  string $_name
	 * @param  mixed|null $_default
	 * @return mixed
	 */
	public function getInput(string $_name, mixed $_default = null): mixed;

	/**
	 * Mengembalikan nilai request method
	 *
	 * @return string
	 */
	public function getMethod(): string;

	/**
	 * Mengembalikan nilai request path
	 *
	 * @return string
	 */
	public function getPath(): string;

	/**
	 * Mengembalikan nilai request query
	 *
	 * @param  string $_name
	 * @param  mixed|null $_default
	 * @return Progress\Contract\Http\InputGetInterface|mixed
	 */
	public function getQuery(string $_name, mixed $_default = null): mixed;
}
