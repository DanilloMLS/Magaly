<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refeicao_item extends Model
{
  protected $fillable = [
    'quantidade',
   ];


  public function refeicao(){
    return $this->hasOne(\App\Refeicao::class);
  }

  public function Item(){
    return $this->hasOne(\App\Item::class);
  }
}
