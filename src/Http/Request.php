<?php

namespace Progress\Http;

use Progress\Contract\Http\RequestInterface;

class Request implements RequestInterface {
	/**
	 * Isi dari request header
	 *
	 * @var array
	 */
	private $_header = [];

	/**
	 * Request HTTP input
	 *
	 * @var Progress\Contract\Http\InputInterface|mixed
	 */
	private $_input;

	/**
	 * Request method
	 *
	 * @var string
	 */
	private $_method;

	/**
	 * Request path
	 *
	 * @var string
	 */
	private $_path;

	public function __construct(Input $_input) {
		foreach ($_SERVER as $_k => $_v) {
			$this->_header[strtolower(str_replace('_', '-', $_k))] = $_v;
		}

		$this->_input = $_input;
		$this->_method = $_input->post('_method', $this->getHeader('request-method'));
		$this->_path = '/' . trim($this->_input->get('url', '/'), '/');
	}

	/**
	 * @inheritdoc
	 */
	public function getFile(string $_name): mixed {
		return $this->_input->file($_name) ?? false;
	}

	/**
	 * @inheritdoc
	 */
	public function getHeader(string $_name, mixed $_default = null): ?string {
		return $this->_header[$_name] ?? $_default;
	}

	/**
	 * @inheritdoc
	 */
	public function setHeader(
		string $_name,
		?string $_value = null
	): RequestInterface {
		$this->_header[strtolower(str_replace(
			[' ', '_'],
			'-',
			$_name
		))] = $_value;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getInput(string $_name, mixed $_default = null): mixed {
		return $this->_input->post($_name, $_default);
	}

	/**
	 * @inheritdoc
	 */
	public function getMethod(): string {
		return $this->_method;
	}

	/**
	 * @inheritdoc
	 */
	public function getPath(): string {
		return $this->_path;
	}

	/**
	 * @inheritdoc
	 */
	public function getQuery(string $_name, mixed $_default = null): mixed {
		return $this->_input->get($_name, $_default);
	}
}
