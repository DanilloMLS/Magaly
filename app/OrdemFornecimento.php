<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemFornecimento extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['fornecedor_id', 'estoque_id', 'observacao'];

    public function fornecedor()
    {
        return $this->belongsTo(\App\Fornecedor::class);
    }

    public function estoque()
    {
        return $this->belongsTo(\App\Estoque::class);
    }

    public function ordem_items()
    {
        return $this->hasMany(\App\Ordem_item::class);
    }
}
