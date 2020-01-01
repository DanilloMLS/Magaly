<?php

use Illuminate\Database\Seeder;

class Refeicao_ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Refeicao_item', 80)->create();
    }
}
