<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estoque_item extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'item_id', 'estoque_id', 'quantidade_danificados', 'quantidade', 'n_lote', 'data_validade',
  ];

  public function estoque(){
    return $this->hasOne(\App\Estoque::class);
  }

  public function item(){
    return $this->hasOne(\App\Item::class);
  }

}