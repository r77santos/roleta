<?php

namespace App\Model;

use App\Core\Database\Dao\Model;

class Winner extends Model
{
    protected $table = 'bioma_dii_2021_ganhadores';

    protected $fillables = [
        'nome',
        'mail',
        'celular',
    ];
}
