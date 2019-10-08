<?php

use Illuminate\Database\Seeder;

class RefeicaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Refeicao', 20)->create();
    }
}
