<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instituicao extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
      'nome', 'estoque_id', 'modalidade_ensino', 'rota', 'periodo_atendimento', 'qtde_alunos', 'endereco', 'gestor', 'telefone'
  ];

  public function distribuicao(){
    return $this->belongsTo(\App\Distribuicao::class);
  }
  
  public function estoque(){
    return $this->hasOne(\App\Estoque::class);
  }
}
