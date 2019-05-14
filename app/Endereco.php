<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
      'rua', 'bairro', 'cep', 'numero'
    ];

    public function escola(){
      return $this->belongsTo(\App\Escola::class);
    }
}
