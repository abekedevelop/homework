<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\CityCountryLink::class, function (Faker $faker) {
    return [
        'city_id' => rand( 1, 3 ),
        'country_id' => rand( 1, 3 )
    ];
});
