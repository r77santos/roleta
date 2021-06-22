<?php 

namespace App\Core\Database\Query;

abstract class SQLAbstract
{
	protected $Table;

	protected $Columns;

	protected $Connection;

	private $Default = 'string';

	protected $Types = [
		'string'  => \PDO::PARAM_STR,
		'integer' => \PDO::PARAM_INT,
		'NULL'    => \PDO::PARAM_NULL,
		'boolean' => \PDO::PARAM_BOOL,
	];

	abstract public function run();

	abstract public function toSql();

	public function __construct($connection)
	{
		$this->Columns = array();
		$this->Connection = $connection;
	}

	protected function type($value)
	{
		$key = gettype($value);
		$type = $this->Types[$this->Default];
		if(isset($this->Types[$key])) {
			$type = $this->Types[$key];
		}
		return $type;
	}

	public function __toString()
	{
		throw new \Exception("Not implemented");
	}
}
