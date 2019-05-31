<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
  protected $fillable = [
      'nome', 'modalidade_ensino', 'rota', 'periodo_atendimento', 'qtde_alunos', 'endereco'
  ];

  public function distribuicao(){
    return $this->belongsTo(\App\Distribuicao::class);
  }
  /*public function endereco(){
    return $this->hasOne(\App\Endereco::class);
  }*/
}
