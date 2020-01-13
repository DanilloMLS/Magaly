<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Estoque_item;
use Faker\Generator as Faker;

$factory->define(Estoque_item::class, function (Faker $faker) {
    $contrato_itens = \App\Contrato_item::all();
    $contrato_item = $faker->randomElement($contrato_itens);
    return [
        'quantidade_danificados' => 0,
        'quantidade' => $faker->numberBetween(10,2000),
        'item_id' => $contrato_item->item_id,
        'estoque_id' => 1,
        'contrato_id' => $contrato_item->contrato_id,
        'n_lote' => $faker->numerify('########'),
        'data_validade' => $faker->dateTimeBetween('now','+3 years'),
    ];
});
