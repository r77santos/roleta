<?php 

namespace App\Core\Database\Query;

trait SQLFilter {

	public $Filter = array();

	protected $Where = array();

	protected function filters()
	{
		return $this->Filter;
	}

	protected function wheres()
	{
		$where = '';
		if(count($this->Where)) {
			$where = ' WHERE ' . implode(' ', $this->Where);
		}
		return $where;
	}

	public function where($column, $operator, $value)
	{
		return $this->filter('AND', $column, $operator, $value);
	}

	public function orWhereIn($column, $values)
	{
		return $this->filterIn('OR', $column, 'IN', $values);
	}

	public function whereIn($column, $values)
	{
		return $this->filterIn('AND', $column, 'IN', $values);
	}

	public function orWhereNotIn($column, $values)
	{
		return $this->filterIn('OR', $column, 'NOT IN', $values);
	}

	public function whereNotIn($column, $values)
	{
		return $this->filterIn('AND', $column, 'NOT IN', $values);
	}

	public function orWhere($column, $operator, $value)
	{
		return $this->filter('OR', $column, $operator, $value);
	}

	public function andWhere($column, $operator, $value)
	{
		return $this->filter('AND', $column, $operator, $value);
	}

	public function filterIn($glude, $column, $operator, $values)
	{
		$keys = array();
		foreach($values as $value) {
			$key = ':' . md5("in_{$column}_{$value}");
			$this->Filter[$key] = $value;
			array_push($keys, $key);
		}

		$where = "{$column} {$operator} (".implode(', ', $keys).")";
		if(count($this->Where) > 0) {
			$where = "{$glude} {$where}";
		}

		$this->Where[] = $where;

		return $this;
	}

	public function filter($glude, $column, $operator, $value)
	{
		$key = ":". md5("filter_{$column}_{$value}");
		$where  = "{$column} {$operator} {$key}";

		if(count($this->Where) > 0) {
			$where = "{$glude} {$where}";
		}

		$this->Where[] = $where;
		$this->Filter[$key] = $value; 

		return $this;
	}

}
