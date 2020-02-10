<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saida_item extends Model
{
    protected $table = 'saida_items';
    use SoftDeletes;
    protected $fillable = ['quantidade_aceita','quantidade_pedida','quantidade_restante',
                           'sem_destino','saida_avulsa_id','itemavulso_estoque_id'
    ];

    public function saidaAvulsa()
    {
        return $this->belongsTo(\App\SaidaAvulsa::class);
    }

    public function itemAvulsoEstoque()
    {
        return $this->hasOne(\App\ItemAvulso_estoque::class);
    }
}
