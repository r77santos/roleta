<?php 

namespace App\Core\Database\Driver;

use App\Core\Database\Driver\DBAbstract;

class MySqlDriver extends DBAbstract
{
	public function __construct()
	{
		parent::__construct('mysql', 'utf8');
	}

	public function __toString()
	{
		$connection = array();
		
		array_push($connection, "host={$this->Hostname}");
		array_push($connection, "dbname={$this->Database}");
		array_push($connection, "charset={$this->Charset}");

		return $this->Prefix . ':' . implode(';', $connection);
	}
}
