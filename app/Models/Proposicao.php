<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposicao extends Model
{
    protected $fillable = [
        'id',
        'siglaTipo',
        'idTipo',
        'ano',
        'ementa',
        'dataHora',
        'idSituacao',
        'nomeDeputado',
    ];

    public function deputados()
    {
        return $this->belongsToMany('App\Models\Deputado');
    }
}
