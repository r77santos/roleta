<?php 

namespace App\Core\Facade;

use App\Core\Database\Query\SQLInsert;
use App\Core\Database\Query\SQLSelect;
use App\Core\Database\Query\SQLUpdate;
use App\Core\Database\Query\SQLDelete;

class Database
{
	protected $Connection;

	public function __construct($connection)
	{
		$this->Connection = $connection;
	}

	public static function build($connection)
	{
		return new static($connection);
	}

	public function getConnection()
	{
		return $this->Connection;
	}

	public function update($table)
	{
		return (new SQLUpdate($this->Connection))->update($table);
	}

	public function delete($table)
	{
		return (new SQLDelete($this->Connection))->delete($table);
	}

	public function insert($table)
	{
		return (new SQLInsert($this->Connection))->insert($table);
	}

	public function select($columns)
	{
		return (new SQLSelect($this->Connection))->select($columns);
	}

	public function exists($columns, $table, $key, $value)
	{
		return $this->select($columns)->from($table)->where($key, '=', $value);
	}

}
