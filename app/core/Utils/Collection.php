<?php

namespace App\Core\Utils;

class Collection
{
    protected $elements;

    public function __construct($elements)
    {
        $this->elements = $elements;
    }

    public function size()
    {
        if(isset($this->elements)) {
            return count($this->elements);
        }
    }

    public function first()
    {
        if($this->size()) {
            foreach($this->elements as $item) {
                return $item;
            }
        }
    }

    public function last()
    {
        $element = null;
        if($this->size()) {
            foreach($this->elements as $item) {
                $element = $item;
            }
        }
        return $element;
    }

    public function add($key, $element)
    {
        if(!\is_array($this->elements)) {
            $this->elements = [];
        }
        if(is_null($key)) {
            array_push($this->elements, $element);
        } else {
            $this->elements[$key] = $element;
        }
        return $this;
    }

    public function each($callback)
    {
        if($this->size()) {
            foreach($this->elements as $key => $value) {
                try {
                    \call_user_func_array($callback, [
                        $value, $key
                    ]);
                } catch (\Exception $Exception) {
                    continue;
                }
            }
        }
    }

    public function drop($callback)
    {
        foreach($this->elements as $key => $value) {
            try {
                $droped = \call_user_func_array($callback, [
                    $value, $key
                ]);
                if($droped) {
                    unset($this->elements[$key]);
                }
            } catch (\Exception $Exception) {
                continue;
            }
        }
        return $this;
    }

    public function get($callback)
    {
        $elements = [];
        foreach($this->elements as $index => $item) {
            try {
                $element = \call_user_func_array($callback, [
                    $item, $index,
                ]);
                if($element) {
                    $elements[$index] = $element;
                }
            } catch (\Exception $Exception) {
                continue;
            }
        }
        return new static($elements);
    }

    public function index($keys)
    {
        $elements = [];
        foreach(array_values($keys) as $key) {
            $element = null;
            if(isset($this->elements[$key])) {
                $element = $this->elements[$key];
            }
            if(!isset($elements[$key])) {
                $elements[$key] = $element;
            } else {
                $array = $elements[$key];
                $elements[$key] = array_merge($array, [$element]);
            }
        }
        return new static($elements);
    }
}
