<?php

namespace App\Core\Database\Driver;

abstract class DBAbstract
{
    public $Prefix;

    public $Charset;

    public $Username;

    public $Password;

    public $Hostname;

    public $Database;

    public $Parameters;

    public function __toString()
    {
        throw new \Exception("Not implemented");
    }

	public function __construct($prefix, $charset)
	{
		$this->Prefix  = $prefix;
		$this->Charset = $charset;
	}
}
