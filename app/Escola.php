<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escola extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
      'nome', 'modalidade_ensino', 'rota', 'periodo_atendimento', 'qtde_alunos', 'endereco', 'gestor', 'telefone'
  ];

  public function distribuicao(){
    return $this->belongsTo(\App\Distribuicao::class);
  }
  /*public function endereco(){
    return $this->hasOne(\App\Endereco::class);
  }*/
}
