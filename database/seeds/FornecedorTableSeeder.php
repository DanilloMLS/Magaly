<?php

use Illuminate\Database\Seeder;
use App\Fornecedor;

class FornecedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fornecedor::create([
            'nome'=>'Queijaria B & S',
            'cnpj'=>'125463987526/42'
        ]);
        Fornecedor::create([
            'nome'=>'Itambé',
            'cnpj'=>'425987987526/65'
        ]);
        Fornecedor::create([
            'nome'=>'Nestlé',
            'cnpj'=>'214463952674/80'
        ]);
    }
}
