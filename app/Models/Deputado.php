<?php

namespace App\Models;
use App\Models\Despesa;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'siglaPartido',
        'siglaUf',
        'idLegislatura',
    ];

    public function despesas()
    {
        return $this->hasMany('App\Models\Despesa', 'despesa_id');
    }

    public function proposicaos()
    {
        return $this->hasMany('App\Models\Proposicao','proposicao_id');
    }
}
