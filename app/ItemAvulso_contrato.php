<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemAvulso_contrato extends Model
{
    protected $table = 'itemavulso_contratos';
    use SoftDeletes;
    protected $fillable = [
        'nome','marca','descricao','contrato_id'
    ];

    public function contrato()
    {
        return $this->belongsTo(\App\Contrato::class);
    }
}
