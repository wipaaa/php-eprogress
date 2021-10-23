<?php

namespace Progress\Http;

use Progress\Contract\Http\ResponseInterface;

class Response implements ResponseInterface {
	/**
	 * Request class holder
	 *
	 * @var Progress\Contract\Http\RequestInterface
	 */
	private $_request;

	public function __construct(Request $_request) {
		$this->_request = $_request;
	}

	/**
	 * @inheritdoc
	 */
	public function back(?string $_fallback = null): ResponseInterface {
		$_url = $this->_request->getHeader(
			'http-referer',
			$_fallback
		);

		return $this->redirect($_url);
	}

	/**
	 * @inheritdoc
	 */
	public function redirect(string $_url): ResponseInterface {
		header(
			sprintf('Location: %s', $_url),
			false,
			302
		);

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function with(string $_name, mixed $_value): ResponseInterface {
		return $this;
	}
}
