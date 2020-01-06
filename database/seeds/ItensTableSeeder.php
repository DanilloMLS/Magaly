<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Item', 500)->create();
    }
}
