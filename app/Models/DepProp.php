<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepProp extends Model
{
    protected $table = 'deputado_proposicao';

    protected $fillable = [
        'deputado_id',
        'proposicao_id',
    ];
}
