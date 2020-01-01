<?php

use Illuminate\Database\Seeder;

class EscolaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Escola', 20)->create();
    }
}
