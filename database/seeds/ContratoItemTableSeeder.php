<?php

use Illuminate\Database\Seeder;

class ContratoItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Contrato_item', 400)->create();
    }
}
