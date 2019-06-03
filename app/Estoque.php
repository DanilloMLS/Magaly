<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
  protected $fillable = [
      'nome'
  ];

  public function item(){
    return $this->hasMany(\App\Item::class);
  }
}