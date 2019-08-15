<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_item extends Model
{
  protected $fillable = [
    'item_id', 'contrato_id', 'quantidade', 'valor_unitario', 'n_lote', 'data_validade',
   ];

  public function item(){
    return $this->hasOne(\App\Item::class);
  }

  public function contrato(){
    return $this->hasOne(\App\Contrato::class);
  }
}
