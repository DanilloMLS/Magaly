<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Instituicao::class, function (Faker $faker) {
    $modalidade = ['Creche Infantil Integral', 'Creche Infantil Parcial',
                   'Infantil', 'Ensino Fundamental', 'EJA', 'Quilombola'];
    $rota = ['Rota 01', 'Rota 02', 'Rota 03', 'Rota 04', 'Rota 05', 'Rota 06',
             'Rota 07', 'Rota 08', 'Rota 09', 'Rota 10'];
    $atendimento = ['Manhã', 'Tarde', 'Noite', 'Manhã Tarde Noite',
                    'Manhã Tarde', 'Manhã Noite', 'Tarde Noite',];
    return [
        'nome' => $faker->unique()->name,
        'modalidade_ensino' => $modalidade[$faker->numberBetween(0, 5)],
        'rota' => $rota[$faker->numberBetween(0, 9)],
        'periodo_atendimento' => $atendimento[$faker->numberBetween(0, 6)],
        'qtde_alunos' => $faker->numberBetween(10, 2000),
        'endereco' => $faker->address,
        'gestor' => $faker->name,
        'telefone' => $faker->numerify('##########'),
        'estoque_id' => function(){return factory(\App\Estoque::class)->create()->id;}
    ];
});
