<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardapio_mensal extends Model
{
  protected $fillable = [
    'data_inicio', 'data_fim', 'modalidade_ensino', 'nome',
   ];

  public function cardapio_semanal(){
    return $this->hasMany(\App\Cardapio_semanal::class);
  }

}
