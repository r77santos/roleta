<?php 

namespace App\Core\Database\Query;

use App\Core\Database\Query\SQLJoins;
use App\Core\Database\Query\SQLFilter;
use App\Core\Database\Query\SQLAbstract;

class SQLDelete extends SQLAbstract
{
	use SQLFilter, SQLJoins;

	public function __construct($connection)
	{
		parent::__construct($connection);
	}

	public function delete($table)
	{
		$this->Table = $table;
		return $this;
	}

	public function toSql()
	{
		return $this->__toString();
	}

	public function __toString()
	{
		$where = $this->wheres();
		return "DELETE FROM {$this->Table} {$where}";
	}

	public function run()
	{
		try {
			$query  = $this->toSql();
			$this->Connection->beginTransaction();
			$stmt = $this->Connection->prepare($query);
			if($stmt->execute($this->filters())) {
				return $this->Connection->commit();
			}
		} catch (\Exception $Exception) {
			$this->Connection->rollBack();
			throw $Exception;
		}
	}

}
