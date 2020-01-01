<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cardapio_diario_refeicao extends Model
{
  protected $fillable = [
    'cardapio_diario_id', 'refeicao_id'
   ];

   public function cardapio_diario(){
     return $this->hasOne(\App\Cardapio_diario::class);
   }

   public function refeicao(){
     return $this->hasOne(\App\Refeicao::class);
   }
}
