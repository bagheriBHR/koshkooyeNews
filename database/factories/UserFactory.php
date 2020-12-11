<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
    return [
        'first_name' => 'bahareh',
        'last_name' => 'bagheri',
        'email'=> 'bagheri_bhr@yahoo.com',
        'password' => \Illuminate\Support\Facades\Hash::make('5Aban1368'),// password
        'remember_token' => Str::random(10),
        'is_admin' => 1,
        'username'=>'baharAdmin99'
    ];
});
