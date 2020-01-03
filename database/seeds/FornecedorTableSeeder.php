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
        factory('App\Fornecedor', 5)->create();
    }
}
