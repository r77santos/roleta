<?php 

namespace App\Core\Database\Query;

use App\Core\Database\Query\SQLLimit;
use App\Core\Database\Query\SQLJoins;
use App\Core\Database\Query\SQLOrder;
use App\Core\Database\Query\SQLFilter;
use App\Core\Database\Query\SQLAbstract;

class SQLSelect extends SQLAbstract
{
	use SQLLimit, SQLJoins, SQLOrder, SQLFilter;

	public function __construct($connection)
	{
		parent::__construct($connection);
	}

	public function from($table)
	{
		$this->Table = $table;
		return $this;
	}

	public function count()
	{
		return count($this->get());
	}

	public function select($columns)
	{
		if(is_array($columns)) {
			foreach($columns as $column) {
				$this->AddColumn($column);
			}
		} else {
			$this->AddColumn($columns);
		}

		return $this;
	}

	protected function AddColumn($column)
	{
		if(!in_array($column, $this->Columns)) {
			array_push($this->Columns, $column);
		}
	}

	public function __toString()
	{
		$joins = $this->joins();
		$where = $this->wheres();
		$orders = $this->orders();
		$limits = $this->limits();

		$columns = implode(', ', $this->Columns);
		
		return "SELECT {$columns} FROM {$this->Table} {$joins} {$where} {$orders} {$limits}"; 
	}

	public function run()
	{
		return $this->get();
	}

	public function toSql()
	{
		return $this->__toString();
	}

	public function first()
	{
		$first = [];
		$rows  = $this->limit(1)->get();
		if( count($rows) ) {
			$first = $rows[0];
		}
		return $first;
	}

	public function get()
	{
		try {
			$rows = array();
			$query = $this->toSql();
			$stmt = $this->Connection->prepare($query);
			if($stmt->execute($this->filters())) {
				while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
					array_push($rows, $row);
				}
			}
			return $rows;
		} catch (\Exception $Exception) {
			throw $Exception;
		}
	}
	
}
