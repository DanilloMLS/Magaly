<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
  protected $fillable = [
      'nome', 'cnpj', 'n_contrato', 'n_processo_licitatorio'
  ];
}
