<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ActivismeBE\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(ActivismeBE\Statusses::class, function (Faker $faker) {
    return [
        'author_id'     => function () { return factory(ActivismeBE\User::class)->create(); },
        'color'         => $faker->hexColor,
        'name'          => $faker->name,
        'description'   => $faker->paragraph
    ];
});

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