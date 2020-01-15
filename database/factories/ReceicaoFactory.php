<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Refeicao::class, function (Faker $faker) {
    $ref = App\Refeicao::All();
    $quant_refeicoes = count($ref) + 1;
    return [
        'nome' => "Refeição ".$faker->numberBetween(1, 25897643146421),
        'descricao' => $faker->text(100),
        'quantidade_total' => 0
    ];
});
