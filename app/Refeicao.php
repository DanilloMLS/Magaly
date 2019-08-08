<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refeicao extends Model
{
  protected $fillable = [
    'nome', 'descricao',
   ];


  public function itens(){
    return $this->hasMany(\App\Item::class);
  }
}
