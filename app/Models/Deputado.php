<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{
    //
    protected $fillable = [
        'id',
        'nome',
        'siglaPartido',
        'siglaUf',
        'idLegislatura',
    ];
}
