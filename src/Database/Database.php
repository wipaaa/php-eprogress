<?php

namespace Progress\Database;

use Progress\Base\Config;
use Progress\Contract\Database\DatabaseInterface;

class Database implements DatabaseInterface {
	/**
	 * Database handler
	 *
	 * @var \PDO
	 */
	private $_handler;

	/**
	 * Database statement handler
	 *
	 * @var \PDOStatement
	 */
	private $_statement;

	/**
	 * Database driver name
	 *
	 * @var string
	 */
	private $_driver;

	/**
	 * Database name
	 *
	 * @var string
	 */
	private $_name;

	/**
	 * Database host name
	 *
	 * @var string
	 */
	private $_host;

	/**
	 * Database host port
	 *
	 * @var string|int
	 */
	private $_port;

	/**
	 * Database user
	 *
	 * @var string
	 */
	private $_user;

	/**
	 * Database user password
	 *
	 * @var string
	 */
	private $_pass;

	public function __construct(Config $_config) {
		$this->_driver = $_config->get('database.driver');
		$this->_name = $_config->get('database.name');
		$this->_host = $_config->get('database.host');
		$this->_port = $_config->get('database.port');
		$this->_user = $_config->get('database.user');
		$this->_pass = $_config->get('database.pass');

		$this->connect();
	}

	/**
	 * @inheritdoc
	 */
	public function bind(
		string $_param,
		mixed $_value,
		mixed $_type = null
	): DatabaseInterface {
		if (is_null($_type)) {
			switch (true) {
				case is_bool($_value): $_type = \PDO::PARAM_BOOL; break;
				case is_int($_value): $_type = \PDO::PARAM_INT; break;
				case is_null($_value): $_type = \PDO::PARAM_NULL; break;
				default: $_type = \PDO::PARAM_STR; break;
			}
		}

		$this->_statement->bindValue($_param, $_value, $_type);
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function execute(): bool {
		$_isExecuted = $this->_statement->execute();

		if ($this->_handler->inTransaction() && $_isExecuted) {
			$this->_handler->commit();
		}

		return $_isExecuted;
	}

	/**
	 * @inheritdoc
	 */
	public function fetch(mixed $_model = null): mixed {
		$this->execute();

		return $this->_statement->fetchObject(
			$_model ?? \stdClass::class,
			is_null($_model) ? [] : [$this]
		);
	}

	/**
	 * @inheritdoc
	 */
	public function fetchAll(mixed $_model = null): mixed {
		$this->execute();

		return $this->_statement->fetchAll(
			\PDO::FETCH_CLASS,
			$_model ?? \stdClass::class,
			$_model === null ? [] : [$this]
		);
	}

	/**
	 * @inheritdoc
	 */
	public function prepare(string $_query): DatabaseInterface {
		$this->_statement = $this->_handler->prepare($_query);
		return $this;
	}

	/**
	 * Membuat koneksi dengan PDO ke database
	 *
	 * @return  void
	 */
	private function connect() {
		try {
			$this->_handler = new \PDO(
				$this->getDsn(),
				$this->_user,
				$this->_pass
			);

			$_options = $this->getOption();

			foreach ($_options as $_k => $_v) {
				$this->_handler->setAttribute($_k, $_v);
			}

			$this->_handler->beginTransaction();
		} catch (\PDOException $_exception) {
			if ($this->_handler instanceof \PDO && $this->_handler->inTransaction()) {
				$this->_handler->rollBack();
			}

			die($_exception->getMessage());
		}
	}

	/**
	 * Mengembalikan string DSN
	 *
	 * @return  string
	 */
	private function getDsn(): string {
		return sprintf(
			"%s:host=%s:%s;dbname=%s;charset=utf8mb4",
			$this->_driver,
			$this->_host,
			$this->_port,
			$this->_name
		);
	}

	/**
	 * Mengembalikan option untuk PDO
	 *
	 * @return  array
	 */
	private function getOption(): array {
		return [
			\PDO::ATTR_CASE => \PDO::CASE_LOWER,
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_ORACLE_NULLS => \PDO::NULL_NATURAL,
			\PDO::ATTR_PERSISTENT => true
		];
	}
}
