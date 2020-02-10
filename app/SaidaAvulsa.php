<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaidaAvulsa extends Model
{
    protected $table = 'saida_avulsas';
    use SoftDeletes;
    protected $fillable = ['observacao','origem_id','destino_id','contrato_id'];

    public function estoque()
    {
        return $this->belongsToMany(\App\Estoque::class);
    }

    public function contrato()
    {
        return $this->belongsTo(\App\Contrato::class);
    }
}
