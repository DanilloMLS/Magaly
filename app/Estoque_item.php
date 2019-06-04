<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque_item extends Model
{
  protected $fillable = [
    'item_id', 'estoque_id', 'quantidade_danificados', 'quantidade',
  ];

  public function estoque(){
    return $this->hasOne(\App\Estoque::class);
  }

  public function item(){
    return $this->hasOne(\App\Item::class);
  }

}