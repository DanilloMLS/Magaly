<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Item::class, function (Faker $faker) {
    $itens = ['Macarrão', 'Arroz', 'Tempero', 'Cebola', 'Carne', 'Macacheira', 'Ovo', 'Presunto', 'Salsicha', 'Queijo',
              'Miojo', 'Batata doce', 'Tomate', 'Pimentão', 'Creme de Leite', 'Farinha', 'Milho Verde', 'Ervilha', 'Azeitona',
              'Feijão', 'Maçã', 'Melão', 'Peixe', 'Abacaxi', 'Acerola', 'Manga', 'Brocolis', 'Morango'];
    $marcas = ['Nike', 'Adidas', 'Nestlé', 'Conga', 'Sony', 'Ericson', 'Philips', 'AOC', 'CCE', 'Lg', 'HP', 'ACER', 'DELL',
               'Mariano', 'Vitarela', 'Garoto', 'Trakinas', 'jatobá', 'Delícia', 'Salada', 'Soya', 'Primor', 'Cardeal', 'Coqueiro',
               'Danone'];
    $unidade = ['g', 'ml'];
    $gramatura = [50, 100, 150, 200, 250, 500, 800, 1000];
    return [
        'nome'=> $itens[$faker->numberBetween(0, 27)],
        'marca'=> $marcas[$faker->numberBetween(0,24)],
        'descricao'=> $faker->text(200),
        'unidade'=> $unidade[$faker->numberBetween(0,1)],
        'gramatura'=>$gramatura[$faker->numberBetween(0,7)]
    ];
});
