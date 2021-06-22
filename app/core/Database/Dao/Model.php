<?php 

namespace App\Core\Database\Dao;

use App\Core\Facade\Database;

class Model
{
    protected $table;

    protected $fillables;

    protected $attributes;

    protected $connection;

    protected $primary = 'id';

    public function __construct($connection)
    {
        $this->attributes = [];
        $this->connection = $connection;
    }

    public static function build($connection)
    {
        return new static($connection);
    }

    public function primaryKey()
    {
        return $this->primary;
    }

    public function primaryValue()
    {
        return $this->__get($this->primary);
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __get($key)
    {
        if( isset($this->attributes[$key]) ) {
            return $this->attributes[$key];
        }
    }

    public function __toString()
    {
        return \json_encode($this->attributes);
    }

    public function fill($fields)
    {
        foreach($fields as $key => $value) {
            if(\in_array($key, $this->fillables) && 
               !is_null($value)) {
                $this->__set($key, $value);
            }
        }
    }

    public function toArray()
    {
        $attributes = [];
        foreach($this->fillables as $key) {
            $attributes[$key] = $this->__get($key);
        }

        return $attributes;
    }

    public function diff()
    {
        return array_diff_key($this->attributes, [ 
            $this->primaryKey() => $this->primaryValue(),
        ]);
    }

    public function save()
    {
        if(!$this->primaryValue()) {
            return $this->create($this->attributes);
        }
        
        return $this->update();
    }

    public function create($values)
    {
        $primary = Database::build($this->connection)
                           ->insert($this->table)
                           ->values($values)
                           ->run();

        if(!is_null($primary) && $primary > 0) {
            $this->__set($this->primaryKey(), $primary);
        }

        return $this->find($primary);
    }

    public function find($value)
    {
        $this->attributes = [];

        $record = Database::build($this->connection)
                          ->select([ '*' ])
                          ->from($this->table)
                          ->where($this->primaryKey(), '=', $value)
                          ->run(1);
        
        if( count($record) > 0 ) {
            $this->attributes = @$record[0];
        }

        return $this->attributes;
    }

    public function delete()
    {
        $deleted = false;

        if( $value = $this->primaryValue() ) {
            $deleted = Database::build($this->connection)
                               ->delete($this->table)
                               ->where($this->primaryKey(), '=', $value)
                               ->run();
        }

        $deleted = \is_bool($deleted) && $deleted === true;

        if($deleted) {
            $this->__set($this->primaryKey(), null);
        }

        return $deleted;
    }

    public function update()
    {
        $updated = false;

        if( $value = $this->primaryValue() ) {
            $updated = Database::build($this->connection)
                                ->update($this->table)
                                ->set($this->diff())
                                ->where($this->primaryKey(), '=', $this->primaryValue())
                                ->run();
        }

        return \is_bool($updated) && $updated === true;
    }
}
