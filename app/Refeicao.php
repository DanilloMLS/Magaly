<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refeicao extends Model
{
  protected $fillable = [
    'nome', 'descricao','peso_liquido',
   ];


  public function itens(){
    return $this->hasMany(\App\Item::class);
  }
}
