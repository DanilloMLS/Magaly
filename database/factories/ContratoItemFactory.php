<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Contrato_item::class, function (Faker $faker) {
    return [
        'quantidade' => $faker->numberBetween(1,3000),
        'valor_unitario' => $faker->numberBetween(1,6),
        'contrato_id' => $faker->numberBetween(1,19),
        'item_id' => $faker->numberBetween(1,19),
    ];
});
