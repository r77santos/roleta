<?php

namespace App\Core\Utils;

class Template
{
    protected $path;
    protected $variables;

    public function __construct()
    {
        $this->path = '';
        $this->variables = [];
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function setVariables($variables)
    {
        $this->variables = $variables;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = realpath("{$path}.php");
        return $this;
    }

    public function drop($key)
    {
        unset($this->variables[$key]);
        return $this;
    }

    public function add($key, $value)
    {
        $this->variables[$key] = $value;
        return $this;
    }

    public function isVariables()
    {
        return count($this->variables) > 0;
    }

    public function get($key)
    {
        if($this->exists($key)) {
            return $this->variables[$key];
        }
    }

    public function printbr($total)
    {
        $counter = 0;
        if($total > $counter) {
            while($total > $counter) {
                echo '<br>';
                $counter++;
            }
        }
    }

    public function printVal($key, $value)
    {
        if($this->exists($key)) {
            $value = $this->get($key);
        }
        echo $value;
    }

    public function exists($key)
    {
        return isset($this->variables[$key]);
    }

    public function render()
    {
        if($this->isVariables()) {
            extract($this->getVariables());
        }
        ob_start();
        include($this->getPath());
        return \ob_get_clean();
    }
}
