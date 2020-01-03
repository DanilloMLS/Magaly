<?php

use Illuminate\Database\Seeder;
use App\Contrato;
use Illuminate\Support\DateFactory;
use Faker\Provider\tr_TR\DateTime;

class ContratoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Contrato', 20)->create();
    }
}
