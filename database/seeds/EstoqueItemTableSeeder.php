<?php

use Illuminate\Database\Seeder;

class EstoqueItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Estoque', 1000)->create();
    }
}
