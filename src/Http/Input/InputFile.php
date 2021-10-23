<?php

namespace Progress\Http\Input;

class InputFile {
	/**
	 * Nama dari input $_FILE
	 *
	 * @var string
	 */
	private $_name;

	/**
	 * Value dari input $_FILE
	 *
	 * @var mixed
	 */
	private $_value;


	public function __construct($_name, $_value) {
        $this->_name = $_name;
        $this->_value = $_value;
    }

    /**
     * @inheritDoc
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * @inheritDoc
     */
    public function getFileName() {
        return $this->_value['name'];
    }

    /**
     * @inheritDoc
     */
    public function getFileType() {
        return $this->_value['type'];
    }

    /**
     * @inheritDoc
     */
    public function save(string $_path, ?string $_name = null) {
        $_name = explode('.', $_name ?? $this->_name)[0];
        $_ext = '.jpg';

        if (move_uploaded_file(
			$this->_value['tmp_name'],
			$_path . DS . $_name . $_ext
		)) {
            return $_name . $_ext;
        }
    }
}
