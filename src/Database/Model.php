<?php

namespace Progress\Database;

use Aura\SqlQuery\QueryFactory;
use Progress\Base\Application;
use Progress\Base\Config;
use Progress\Facade\Container;

trait Model {
	/**
	 * QueryFactory class instance
	 *
	 * @var Aura\SqlQuery\QueryFactory
	 */
	private $_factory;

	/**
	 * Config class instance
	 *
	 * @var Progress\Base\Config
	 */
	protected $_config;

	/**
	 * Database class instance
	 *
	 * @var Progress\Database\Database
	 */
	protected $_database;

	/**
	 * Query class instance
	 *
	 * @var stdClass
	 */
	protected $_query;

	public function __construct() {
		$this->_config = Application::instance()->make(Config::class);
		$this->_database = Application::instance()->make(Database::class);

		$this->_factory = new QueryFactory(
			$this->_config->get('database.driver'),
			QueryFactory::COMMON
		);

		$this->_query = new \stdClass;

		$this->_query->select = $this->_factory->newSelect();
		$this->_query->insert = $this->_factory->newInsert();
		$this->_query->update = $this->_factory->newUpdate();
		$this->_query->delete = $this->_factory->newDelete();
	}

	/**
	 * Mengambil seluruh data dari database
	 *
	 * @return array
	 */
	public function scopeAll(): array {
		$_query = $this->_query->select
			->cols(['*'])
			->from($this->_table);

		return $this->_database
			->prepare($_query->getStatement())
			->fetchAll(static::class);
	}

	public function scopeCreate() {
		$_query = $this->_query->insert
			->into($this->_table)
			->cols($this->_allow);

		$this->_database->prepare($_query->getStatement());

		foreach ($this->_allow as $_allowed) {
			$this->_database->bind(':' . $_allowed, $this->{$_allowed});
		}

		return $this->_database->execute();
	}

	public function scopeDelete(mixed $_id, ?string $_col) {
		$_col = is_null($_col) ? 'id' : $_col;
		$_query = $this->_query->delete
			->from($this->_table)
			->where("{$_col} = :{$_col}");

		return $this->_database
			->prepare($_query->getStatement())
			->bind(":{$_col}", $_id)
			->execute();
	}

	/**
	 * Mengambil sebagian data berdasarkan id pada database
	 *
	 * @param  mixed $_id
	 * @param  string|null $_col
	 * @return object
	 */
	public function scopeFind(mixed $_id, ?string $_col) {
		$_col = is_null($_col) ? 'id' : $_col;
		$_query = $this->_query->select
			->cols(['*'])
			->from($this->_table)
			->where("{$_col} = :{$_col}");

		return $this->_database
			->prepare($_query->getStatement())
			->bind($_col, $_id)
			->fetch(static::class);
	}

	public function scopeSave() {
		$_query = $this->_query->update
			->table($this->_table)
			->cols($this->_allow)
			->where('id = :id');

		$this->_database->prepare($_query->getStatement());
		$this->_database->bind(':id', $this->id);

		foreach ($this->_allow as $_allowed) {
			$this->_database->bind(':' . $_allowed, $this->{$_allowed});
		}

		return $this->_database->execute();
	}

	public function __call(string $_name, array $_args) {
		return call_user_func_array(
			[$this, 'scope' . ucfirst($_name)],
			$_args
		);
	}

	public static function __callStatic(string $_name, array $_args) {
		return Container::call(
			self::class,
			'scope' . ucfirst($_name),
			$_args
		);
	}
}
