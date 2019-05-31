<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
  protected $fillable = [
      'nome', 'cnpj'
  ];

  public function contratos(){
    return $this->hasMany(\App\Contrato::class);
  }
}
