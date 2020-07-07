<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transfer;
use Faker\Generator as Faker;

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        // aqui se anade cada comuna de tabla transfers
        'description'   => $faker->text($maxChars=200),
        'amount'        => $faker->numberBetween($min=10,$max=90),
        'wallet_id'     => $faker->randomDigitNotNull
    ];
});
