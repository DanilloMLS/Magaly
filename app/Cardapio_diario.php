<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardapio_diario extends Model
{
  protected $fillable = [
    'dia_semana',
   ];

  public function cardapio_semanal(){
    return $this->belongsToOne(\App\Cardapio_semanal::class);
  }

  public function refeicao(){
    return $this->hasMany(\App\Refeicao::class);
  }
}
