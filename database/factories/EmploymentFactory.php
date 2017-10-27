<?php

use Faker\Generator as Faker;

$factory->define(Genealogy\Hocs\Employments\Employment::class, function (Faker $faker) {
    return [
        'company'     => $faker->name,
        'position'    => $faker->name,
        'description' => $faker->paragraph,
        'is_current'  => random_int(0, 1),
        'user_id'     => random_int(1, 10),
        'started_at'  => $faker->dateTime,
        'ended_at'    => $faker->dateTime,
    ];
});
