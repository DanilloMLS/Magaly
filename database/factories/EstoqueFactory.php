<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Estoque::class, function (Faker $faker) {
    return [
        'nome' => "Estoque".$faker->randomDigit(5)
    ];
});
