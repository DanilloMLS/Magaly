<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemAvulso_estoque extends Model
{
    protected $table = 'itemavulso_estoques';
    use SoftDeletes;
    protected $fillable = ['quantidade','estoque_id','itemavulso_contrato_id'];

    public function estoque()
    {
        return $this->belongsTo(\App\Estoque::class);
    }

    public function itemAvulsoContrato()
    {
        return $this->hasOne(\App\ItemAvulso_contrato::class);
    }
}
