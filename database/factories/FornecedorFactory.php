<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Fornecedor::class, function (Faker $faker) {
    return [
        'nome'=> $faker->name,
        'email' => $faker->email,
        'telefone' => $faker->phoneNumber,
        'cnpj' => $faker->numberBetween(1010080000500, 999999999999)
    ];
});
