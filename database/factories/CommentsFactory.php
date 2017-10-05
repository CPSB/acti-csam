<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBE\Comments::class, function (Faker $faker) {
    return [
        'author_id' => function () { return factory(ActivismeBE\User::class)->create()->id; },
        'comment'   => $faker->sentence,
    ];
});
