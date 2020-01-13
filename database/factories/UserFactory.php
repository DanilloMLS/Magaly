<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    /*
    return [
        'name' => "Suporte",
        'email' => "seducdivtecnologia@gmail.com",
        'password' => password_hash("|u`Ut/_bF,oT+^(fv=N/n*\xs*!]@*RM!@;\c~/7\u.\8o-&kLfdYtX7Ci[Eh`ev4", PASSWORD_DEFAULT), // password
        'tipo_user' => 'adm',
    ];
    */
    return [
        'name' => "Teste",
        'email' => "teste@teste",
        'password' => password_hash("testeteste", PASSWORD_DEFAULT), // password
        'tipo_user' => 'adm',
    ];
});