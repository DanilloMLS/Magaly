<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdemServico extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['ordem_item_id', 'quantidade', 'observacao'];

    public function ordemItem()
    {
        return $this->belongsTo(\App\Ordem_item::class);
    }
}
