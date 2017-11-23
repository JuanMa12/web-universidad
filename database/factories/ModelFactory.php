<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\Participant;
use App\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'uuid'=> $faker->uuid,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone' => $faker->phoneNumber,
        'codeActive' => str_random(6),
        'avatar' => 'user.gif',
        'remember_token' => str_random(10),
    ];
});

$factory->define(Participant::class, function (Faker\Generator $faker) {

    return [
        'uuid'=> $faker->uuid,
        'name' => $faker->name,
        'gender' => 'masculino',
        'years' => $faker->numberBetween(1,100),
        'document' =>  $faker->numberBetween(1,10000000),
        'active' => '0'
    ];
});
