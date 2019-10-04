<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Refeicao::class, function (Faker $faker) {
    return [
        'nome' => "Refeicao ".$faker->numberBetween(1, 2345),
        'descricao' => $faker->text(100),
        'quantidade_total' => 0
    ];
});
