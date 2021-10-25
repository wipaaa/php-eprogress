<?php

namespace Progress\Http;

use Progress\Contract\Http\InputInterface;
use Progress\Http\Input\InputFile;
use Progress\Http\Input\InputGet;
use Progress\Http\Input\InputPost;

class Input implements InputInterface {
	/**
	 * FILE data
	 *
	 * @var array
	 */
	private $_files = [];

	/**
	 * GET data
	 *
	 * @var array
	 */
	private $_gets = [];

	/**
	 * POST data
	 *
	 * @var array
	 */
	private $_posts = [];

	public function __construct() {
		foreach ($_GET as $_k => $_v) {
			$this->_gets[] = new InputGet($_k, $_v);
		}

		foreach ($_FILES as $_k => $_v) {
			$this->_files[] = new InputFile($_k, $_v);
		}

		$_postVar = $_POST;

		if (count($_postVar) === 0) {
			parse_str(file_get_contents('php://input'), $_postVar);
		}

		foreach ($_postVar as $_k => $_v) {
			$this->_posts[] = new InputPost($_k, $_v);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function file(string $_name): mixed {
		foreach ($this->_files as $_file) {
			if ($_name === $_file->getName()) {
				return $_file;
			}
		}

		return false;
	}

	/**
	 * @inheritdoc
	 */
	public function get(string $_name, mixed $_default = null): mixed {
		if ($_name === '*') {
			return $this->_gets;
		}

		foreach ($this->getGetIterator() as $_get) {
			if ($_name === $_get->getName()) {
				return $_get;
			}
		}

		return $_default;
	}

	/**
	 * @inheritdoc
	 */
	public function post(string $_name, mixed $_default = null): mixed {
		if ($_name === '*') {
			return $this->_posts;
		}

		foreach ($this->getPostIterator() as $_post) {
			if ($_name === $_post->getName()) {
				return $_post;
			}
		}

		return $_default;
	}

	/**
	 * Generator get data
	 *
	 * @return Generator
	 */
	private function getGetIterator(): \Generator {
		$_getLength = count($this->_gets);

        for ($_index = 0; $_index < $_getLength; ++$_index) {
            yield $this->_gets[$_index];
        }
	}

	/**
	 * Generator post data
	 *
	 * @return Generator
	 */
	private function getPostIterator(): \Generator {
		$_postLength = count($this->_posts);

        for ($_index = 0; $_index < $_postLength; ++$_index) {
            yield $this->_posts[$_index];
        }
	}
}
