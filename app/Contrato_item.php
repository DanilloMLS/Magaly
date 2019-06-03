<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato_item extends Model
{
  protected $fillable = [
    'quantidade', 'valor_unitario',
   ];

  public function item(){
    return $this->hasOne(\App\Item::class);
  }

  public function contrato(){
    return $this->hasOne(\App\Contrato::class);
  }
}
