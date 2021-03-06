<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Contrato::class, function (Faker $faker) {
    $modalidades = ['Modalidade 01', 'Modalidade 02', 'Modalidade 03','Modalidade 04','Modalidade 05'];
    $fornecedores = \App\Fornecedor::All();
    return [
        'data' => $faker->dateTimeBetween('now','+2 years'),
        'fornecedor_id' => $faker->randomElement($fornecedores),
        'n_contrato' => $faker->numberBetween(50,5634)."/".$faker->numberBetween(50,5634),
        'modalidade' => $modalidades[$faker->numberBetween(0,4)],
        'n_processo_licitatorio' => $faker->randomDigit(1800)."/2019".$faker->date('d-m')
    ];
});
