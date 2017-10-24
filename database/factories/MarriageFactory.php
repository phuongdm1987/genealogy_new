<?php

use Faker\Generator as Faker;

$factory->define(Genealogy\Hocs\Marriages\Marriage::class, function (Faker $faker) {
    return [
        'husband_id' => random_int(1, 10),
        'wife_id'    => random_int(1, 10),
        'started_at' => $faker->dateTime,
        'ended_at'   => $faker->dateTime,
    ];
});
