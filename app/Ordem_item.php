<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ordem_item extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['ordem_fornecimento_id', 'contrato_id', 'quantidade', 'quantidade_danificados'];

    public function ordem_fornecimento()
    {
        return $this->belongsTo(\App\OrdemFornecimento::class);
    }

    public function contrato()
    {
        return $this->belongsTo(\App\Contrato::class);
    }
}
