<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Refeicao_item::class, function (Faker $faker) {
    $itens = \App\Item::All();
    $refeicoes = \App\Refeicao::All();
    return [
        'quantidade' => $faker->numberBetween(1, 30),
        'item_id' => $itens[$faker->numberBetween(0, 1999)]->id,
        'refeicao_id' => $refeicoes[$faker->numberBetween(0, 19)]->id
    ];
});
