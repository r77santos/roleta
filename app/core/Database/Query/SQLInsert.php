<?php 

namespace App\Core\Database\Query;

use App\Core\Database\Query\SQLAbstract;

class SQLInsert extends SQLAbstract
{
	protected $Values;

	public function __construct($connection)
	{
		parent::__construct($connection);
	}

	public function insert($table)
	{
		$this->Table = $table;
		return $this;
	}

	public function values($values)
	{
		foreach($values as $key => $value) {
			$key_md5 = ':' . md5("insert_{$key}");
			$this->Columns[] = $key;
			$this->Values[$key_md5] = $value;
		}
		return $this;
	}

	public function toSql()
	{
		return $this->__toString();
	}

	public function __toString()
	{
		$columns = implode(', ', $this->Columns);
		$values  = implode(', ', array_keys($this->Values)); 

		return "INSERT INTO {$this->Table} ({$columns}) VALUES ({$values})";
	}

	public function run()
	{
		try {
			$lastid = null;
			$query  = $this->toSql();
			$this->Connection->beginTransaction();
			$stmt = $this->Connection->prepare($query);
			if($stmt->execute($this->Values)) {
				$lastid = $this->Connection->lastInsertId();
				$this->Connection->commit();
			}
			return $lastid;
		} catch (\Exception $Exception) {
			$this->Connection->rollBack();
			throw $Exception;
		}
	}
}
