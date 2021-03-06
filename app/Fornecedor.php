<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
      'nome', 'cnpj', 'telefone', 'email'
  ];

  public function contratos(){
    return $this->hasMany(\App\Contrato::class);
  }
}
