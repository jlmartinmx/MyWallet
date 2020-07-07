<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Wallet;
use Faker\Generator as Faker;

$factory->define(Wallet::class, function (Faker $faker) {
    return [
        // aqui se anade cada comuna de tabla wallets
        'money' => $faker->numberBetween($min=500,$max=900)
    ];
});
