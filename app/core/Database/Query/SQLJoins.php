<?php 

namespace App\Core\Database\Query;

trait SQLJoins {

	protected $Joins = array();

	protected function joins()
	{
		return implode(' ', $this->Joins);
	}

	public function left($table, $foreign, $primary)
	{
		return $this->join('LEFT', $table, $foreign, $primary);
	}

	public function right($table, $foreign, $primary)
	{
		return $this->join('RIGHT', $table, $foreign, $primary);
	}

	public function inner($table, $foreign, $primary)
	{
		return $this->join('INNER', $table, $foreign, $primary);
	}

	public function full($table, $foreign, $primary)
	{
		return $this->join('FULL OUTER', $table, $foreign, $primary);
	}

	public function join($type, $table, $foreign, $primary)
	{
		$this->Joins[] = "{$type} JOIN {$table} ON {$this->Table}.{$primary} = {$table}.{$foreign}";
		return $this;
	}

}
