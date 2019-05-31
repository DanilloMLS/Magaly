<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
  protected $fillable = [
    'data', 'valor_total', 'n_contrato',  'n_processo_licitatorio' , 'descricao'
   ];

  public function fornecedor(){
    return $this->belongsTo(\App\Fornecedor::class);
  }

  public function itens(){
    return $this->hasMany(\App\Item::class);
  }
}
