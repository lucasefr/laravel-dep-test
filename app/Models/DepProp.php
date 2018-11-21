<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepProp extends Model
{
    //
    protected $table = 'deputados_proposicaos';

    protected $fillable = [
        'deputado_id',
        'proposicao_id',
    ];
}
