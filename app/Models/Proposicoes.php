<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposicoes extends Model
{
    protected $fillable = [
        'id',
        'deputado_id',
        'siglaTipo',
        'idTipo',
        'ano',
        'ementa',
        'dataHora',
        'idSituacao',
    ];
}
