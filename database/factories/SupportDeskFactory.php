<?php

use Faker\Generator as Faker;

$factory->define(ActivismeBE\SupportDesk::class, function (Faker $faker) {
    return [
        'author_id'     => function () { return factory(ActivismeBE\User::class)->create(); },
        'assignee_id'   => function () { return factory(ActivismeBE\User::class)->create(); },
        'category_id'   => function () { return factory(ActivismeBE\Categories::class)->create(); },
        'status_id'     => function () { return factory(ActivismeBE\Statusses::class)->create(); },
        'subject'       => $faker->paragraph(1),
        'description'   => $faker->paragraphs(3)
    ];
});