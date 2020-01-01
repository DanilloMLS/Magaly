<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'data', 'valor_total', 'n_contrato',  'n_processo_licitatorio' , 'descricao', 'modalidade'
   ];

  public function fornecedor(){
    return $this->belongsTo(\App\Fornecedor::class);
  }

  public function itens(){
    return $this->hasMany(\App\Item::class);
  }
}
