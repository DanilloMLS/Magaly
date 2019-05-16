<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = [
    'valor_unitario', 'data_validade','n_lote','descricao','unidade'
   ];

  public function Contrato(){
    return $this->belongsTo(\App\Contrato::class);
  }
}