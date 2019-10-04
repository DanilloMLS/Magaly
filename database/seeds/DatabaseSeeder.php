<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //É possível executar um seeder mais de uma vez
        //É necessário referenciar aqui cada seeder que será executado
        $this->call(ItensTableSeeder::class);
        $this->call(EscolaTableSeeder::class);
        //$this->call(EstoqueTableSeeder::class);
        $this->call(RefeicaoTableSeeder::class);
        $this->call(FornecedorTableSeeder::class);
        $this->call(ContratoTableSeeder::class);
        $this->call(Refeicao_ItemTableSeeder::class);
    }
}
