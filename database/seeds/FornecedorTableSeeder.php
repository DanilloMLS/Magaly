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
        $fake = Fake\Factory::create('pt_BR');
        for($i = 0; $i < 10; $i++){
            Fornecedor::create([
                'nome'=>$fake->name,
                'cnpj'=>'125463987526/42'
            ]);
        }
    }
}
