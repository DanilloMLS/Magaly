<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribuicao_item extends Model
{
  protected $fillable = [
    'item_id', 
    'distribuicao_id', 
    'quantidade_danificados', 
    'quantidade_falta', 
    'quantidade', 
    'quantidade_total', 
    'quantidade_aceita', 
    'baixada', 
    'proxima'
  ];

  public function distribuicao(){
    return $this->hasOne(\App\Distribuicao::class);
  }

  public function item(){
    return $this->hasOne(\App\Item::class);
  }

}
