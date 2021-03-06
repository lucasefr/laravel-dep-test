<?php

namespace App\Models;

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
        return $this->hasMany('App\Models\Despesa');
    }

    public function proposicaos()
    {
        return $this->belongsToMany('App\Models\Proposicao');
    }
}
