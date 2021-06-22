<?php 

namespace App\Core\Database\Query;

use App\Core\Database\Query\SQLJoins;
use App\Core\Database\Query\SQLFilter;
use App\Core\Database\Query\SQLAbstract;

class SQLUpdate extends SQLAbstract
{
	use SQLFilter, SQLJoins;

	protected $Values;

	public function __construct($connection)
	{
		$this->Connection = $connection;
	}

	public function update($table)
	{
		$this->Table = $table;
		return $this;
	}

	public function set($columns)
	{
		foreach($columns as $column => $value) {
			$key = ':' . md5("set_{$column}");
			$this->Values[$key] = $value;
			$this->Columns[] = "{$column} = {$key}";
		}
		return $this;
	}

	public function toSql()
	{
		return $this->__toString();
	}

	public function __toString()
	{
		$where = $this->wheres();
		$columns = implode(', ', array_values($this->Columns));
		return "UPDATE {$this->Table} SET {$columns} {$where}";
	}

	protected function values()
	{
		$values = array();
		foreach($this->Values as $key => $value) {
			$values[$key] = $value;
		}
		foreach($this->filters() as $key => $value) {
			$values[$key] = $value;
		}
		return $values;
	}

	public function run($limit = null)
	{
		try {
			$query  = $this->toSql();
			$this->Connection->beginTransaction();
			$stmt = $this->Connection->prepare($query);
			$values = array();
			foreach($this->values() as $key => &$value) {
				if(is_array($value)) { 
					$values = array_values($value);
					$stmt->bindParam($key, $values[0], $values[1]);
				} else {
					$stmt->bindParam($key, $value, $this->type($value));
				}
			}
			if($stmt->execute()) {
				return $this->Connection->commit();
			}
		} catch (\Exception $Exception) {
			$this->Connection->rollBack();
			throw $Exception;
		}
	}
}
