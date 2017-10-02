<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBE\Statusses::class, function (Faker $faker) {
    return [
        'author_id'     => function () { return factory(ActivismeBE\User::class)->create(); },
        'color'         => $faker->hexColor,
        'name'          => $faker->name,
        'description'   => $faker->paragraph
    ];
});