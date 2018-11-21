<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposicao extends Model
{
    //
    protected $fillable = [
        'id',
        'siglaTipo',
        'idTipo',
        'ano',
        'ementa',
        'dataHora',
        'idSituacao',
    ];
}