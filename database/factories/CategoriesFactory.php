<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBE\Categories::class, function (Faker $faker) {
    return [
        'author_id'     => function () { return factory(ActivismeBE\User::class)->create()->id; },
        'color'         => $faker->hexColor,
        'name'          => $faker->word,
        'module'        => $faker->word,
        'description'   => $faker->word,
    ];
});
