<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estoque_item;
use Faker\Generator as Faker;

$factory->define(Estoque_item::class, function (Faker $faker) {
    return [
        'quantidade_danificados' => 0,
        'quantidade' => $faker->numberBetween(10,2000),
        'item_id' => $faker->numberBetween(1,1999),
        'estoque_id' => $faker->numberBetween(1,19),
        'contrato_id' => $faker->numberBetween(1,19),
    ];
});
