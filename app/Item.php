<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'nome', 'marca' ,'data_validade','descricao','unidade','gramatura'
   ];


  public function escolas(){
    return $this->belongsToMany(\App\Escola::class);
  }

  public function distribuicoes(){
    return $this->belongsToMany(\App\Distribuicao::class);
  }
}
