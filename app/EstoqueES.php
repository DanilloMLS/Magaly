<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstoqueES extends Model
{
  protected $fillable = [
      'quantidade_danificados', 'quantidade', 'operacao', 'item_id', 'estoque_id',
  ];

  public function item(){
    return $this->hasMany(\App\Item::class);
  }

  public function estoque(){
    return $this->hasOne(\App\Estoque::class);
  }
}