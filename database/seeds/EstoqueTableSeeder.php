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
        factory('App\Estoque', 1)->create();
    }
}
