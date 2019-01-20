<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Country::class, function (Faker $faker) {
    return [
        'country_name_ru' => $faker->name,
        'country_name_en' => $faker->name
    ];
});
