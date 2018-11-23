<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $fillable = [
        'deputado_id',
        'ano',
        'mes',
        'tipoDespesa',
        'dataDocumento',
        'valorDocumento',
        'idDocumento',
    ];

    public function deputado()
    {
        return $this->belongsTo('App\Models\Deputado');
    }
}
