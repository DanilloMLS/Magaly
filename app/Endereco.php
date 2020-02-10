<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
      'rua', 'bairro', 'cep', 'numero'
    ];

    public function instituicao(){
      return $this->belongsTo(\App\Instituicao::class);
    }
}
