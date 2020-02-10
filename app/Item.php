<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'nome','marca','descricao','unidade','gramatura'
   ];


  public function instituicaos(){
    return $this->belongsToMany(\App\Instituicao::class);
  }

  public function distribuicoes(){
    return $this->belongsToMany(\App\Distribuicao::class);
  }
}
