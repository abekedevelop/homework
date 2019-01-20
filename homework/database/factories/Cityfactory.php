<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Cities::class, function (Faker $faker) {
    return [
        'city_name_ru' => $faker->name,
        'city_name_en' => $faker->name,
        'city_has_connection' => 1
    ];
});
