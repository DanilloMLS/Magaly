<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estoque extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
      'nome'
  ];

  public function item(){
    return $this->hasMany(\App\Item::class);
  }

  public function instituicao(){
    return $this->belongsTo(\App\Instituicao::class);
  }
}