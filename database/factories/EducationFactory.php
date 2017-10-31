<?php

use Faker\Generator as Faker;

$factory->define(Genealogy\Hocs\Educations\Education::class, function (Faker $faker) {
    return [
        'user_id'     => random_int(1, 10),
        'school'      => $faker->name,
        'subject'     => $faker->name,
        'degree'      => $faker->name,
        'description' => $faker->paragraph,
        'started_at'  => $faker->dateTime,
        'ended_at'    => $faker->dateTime,
    ];
});
