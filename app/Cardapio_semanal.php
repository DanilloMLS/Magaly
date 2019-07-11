<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardapio_semanal extends Model
{
  protected $fillable = [
    'semana',
   ];

  public function cardapio_mensal(){
    return $this->belongsToOne(\App\Cardapio_mensal::class);
  }

  public function cardapio_diario(){
    return $this->hasMany(\App\Cardapio_diario::class);
  }
}
