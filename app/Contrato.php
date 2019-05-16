<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
  protected $fillable = [
    'valor_total', 'valor_restante'
   ];

  public function fornecedor(){
    return $this->belongsTo(\App\Fornecedor::class);
  }
}
