<?php

use Illuminate\Database\Seeder;
use App\Estoque;

class EstoqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estoque::create([
            'nome'=>'EstoqueTeste1'
        ]);
        Estoque::create([
            'nome'=>'EstoqueTeste2'
        ]);
        Estoque::create([
            'nome'=>'EstoqueTeste3'
        ]);
        Estoque::create([
            'nome'=>'EstoqueTeste4'
        ]);
        Estoque::create([
            'nome'=>'EstoqueTeste5'
        ]);
    }
}
