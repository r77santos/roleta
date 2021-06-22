<?php

namespace App\Core\Rules;

use \PDO;
use Rakit\Validation\Rule;

class UniqueRule extends Rule
{
    protected $implicit = true;
    
    protected $connection;

    protected $message = ':attribute :value has been used';

    protected $fillableParams = ['table', 'column', 'except'];

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function check($value): bool
    {
        $this->requireParameters(['table', 'column']);

        $column = $this->parameter('column');
        $except = $this->parameter('except');
        $table = $this->parameter('table');

        $statment = $this->connection->prepare("SELECT count(*) AS count FROM `{$table}` WHERE `{$column}` = :value");
        $statment->bindParam(':value', $value);
        $statment->execute();
        $data = $statment->fetch(\PDO::FETCH_ASSOC);

        return intval($data['count']) === 0;
    }

}
