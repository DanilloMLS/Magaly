<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $fillable = [
    'data_validade','n_lote','descricao','unidade','gramatura'
   ];


  public function escolas(){
    return $this->belongsToMany(\App\Escola::class);
  }

  public function distribuicoes(){
    return $this->belongsToMany(\App\Distribuicao::class);
  }
}
