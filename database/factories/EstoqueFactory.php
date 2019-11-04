<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Estoque::class, function (Faker $faker) {
    $quantidade = count(\App\Estoque::All());
    return [
        'nome' => "Estoque ".$quantidade
    ];
});
