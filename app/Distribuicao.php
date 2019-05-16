<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribuicao extends Model
{
  protected $fillable = [
    'observacao',
  ];

  public function escola(){
    return $this->belongsTo(\App\Escola::class);
  }
}
