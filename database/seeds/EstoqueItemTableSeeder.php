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
        factory('App\Estoque_item', 500)->create();
    }
}
