<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Item::class, function (Faker $faker) {
    $itens = ['Macarrão', 'Arroz', 'Tempero', 'Cebola', 'Carne', 'Macaxeira', 'Ovo', 'Presunto', 'Salsicha', 'Queijo',
              'Miojo', 'Batata doce', 'Tomate', 'Pimentão', 'Creme de Leite', 'Farinha', 'Milho Verde', 'Ervilha', 'Azeitona',
              'Feijão', 'Maçã', 'Melão', 'Peixe', 'Abacaxi', 'Acerola', 'Manga', 'Brocolis', 'Morango',"Banana", "Maçã", "Laranja", 
              "Limão", "Morango", "Pera", "Mamão", "Tomate", "Cebola", "Alface", "Batata", "Cenoura", "Repolho", "Brócolis", 
              "Couve", "Couve-flor", "Beterraba", "Berinjela", "Bovina", "Suína", "Frango", "Peixes", "Açúcar", "Arroz", "Feijão", 
              "Farinha", "Azeite", "Óleo", "Café", "Chá", "Biscoitos", "Leite condensado", "Creme de leite", "Chocolate em pó", 
              "Fubá", "Macarrão", "Molho de tomate", "Maisena", "Vinagre", "Pipoca", "Cereais", "Ovo", "Queijo", "Sal", "Pimenta",
               "Alho", "Temperos prontos", "Orégano", "Salsinha", "Cebolinha", "Mostarda", "Hortelã", "Alecrim", "Pão", "Margarina",
                "Maionese", "Frios fatiados", "Geleia", "Catchup", "Requeijão", "Fermento", "Amido ", "Baunilha", "Gelatina", "Iogurte"];
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
