<?php 

namespace App\Core\Database\Query;

trait SQLOrder {

	protected $Orders = array();
    
	public function orderByDesc($column)
	{
		return $this->orderBy($column, 'desc');
	}

	public function OrderByAsc($column)
	{
		return $this->orderBy($column, 'asc');
	}

	public function orderBy($column, $type)
	{
        $this->Orders[] = "{$column} {$type}";
		return $this;
    }
    
	protected function orders()
	{
        if($orders = implode(', ', $this->Orders)) {
            return "ORDER BY " . $orders;
        }
    }
    
}
