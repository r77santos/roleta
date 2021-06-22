<?php 

namespace App\Core\Database\Driver;

use App\Core\Database\Driver\DBAbstract;

class MsSqDriver extends DBAbstract
{
	public function __construct()
	{
		parent::__construct('sqlsrv', null);
	}

	public function __toString()
	{
		$connection = array();
		
		array_push($connection, "Server={$this->Hostname}");
		array_push($connection, "Database={$this->Database}");

		return $this->Prefix . ':' . implode(';', $connection);
	}
}
