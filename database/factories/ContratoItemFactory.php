<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Contrato_item::class, function (Faker $faker) {
    $itens = \App\Item::All();
    $contratos = \App\Contrato::All();
    $item = ($faker->randomElement($itens));
    $contrato = ($faker->randomElement($contratos));
    return [
        'quantidade' => $faker->numberBetween(100, 300),
        'valor_unitario' => $faker->numberBetween(1, 25),
        'contrato_id' => $contrato->id,
        'item_id' => $item->id
    ];
});
