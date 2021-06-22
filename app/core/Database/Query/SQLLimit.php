<?php 

namespace App\Core\Database\Query;

trait SQLLimit {

	public $Limit = [];

	public function limit($min, $max = null)
	{
		$this->Limit = [ (int) $min ];
		if( !is_null($max) )
		{
			$this->Limit[] = (int) $max;
		}
		return $this;
	}

	protected function limits()
	{
		$limit = '';
		if( count($this->Limit) ) {
			$limit = ' LIMIT ' . implode(', ', $this->Limit);
		}

		return $limit;
	}

}
