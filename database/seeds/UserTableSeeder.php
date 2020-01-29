<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
        'name' => "Suporte",
        'email' => "seducdivtecnologia@gmail.com",
        'password' => password_hash("blooming-spire-53675", PASSWORD_DEFAULT), // password
        'tipo_user' => 'adm',
    ]);
    }
}
