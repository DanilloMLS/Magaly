<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'nome'=>'Achocolatado',
            'data_validade'=>'01/02/2020',
            'n_lote'=>'002',
            'descricao'=>'Nescau em pó, chocolate ao leite',
            'unidade'=>'g',
            'gramatura'=>'500'
        ]);
        Item::create([
            'nome'=>'Leite em pó Itambé',
            'data_validade'=>'01/02/2020',
            'n_lote'=>'002',
            'descricao'=>'Leite em pó integral e instantâneo',
            'unidade'=>'g',
            'gramatura'=>'250'
        ]);
        Item::create([
            'nome'=>'Queijo coalho',
            'data_validade'=>'01/12/2019',
            'n_lote'=>'018',
            'descricao'=>'Queijo de leite coalhado',
            'unidade'=>'g',
            'gramatura'=>'1000'
        ]);
        Item::create([
            'nome'=>'Leite condensado',
            'data_validade'=>'01/05/2020',
            'n_lote'=>'011',
            'descricao'=>'Leite condensado em caixinha',
            'unidade'=>'g',
            'gramatura'=>'150'
        ]);
        //
    }
}
