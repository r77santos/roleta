<?php

namespace App\Model;

use App\Core\Database\Dao\Model;

class Contact extends Model
{
    protected $table = 'bioma_dii_2021_pesquisa';

    protected $fillables = [
        'nome',
        'mail',
        'created',
        'celular',
    ];
}
