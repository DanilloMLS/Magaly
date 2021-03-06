<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distribuicao extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'observacao','estoque_id'
  ];

  public function instituicao(){
    return $this->belongsTo(\App\Instituicao::class);
  }

  public function itens(){
    return $this->hasMany(\App\Item::class);
  }
}
