<?php

namespace App\Http\Controllers\Api;

use App\Modules\Country\CountryGet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function getCountriesByCityId ( Request $request) {
        $cityId = $request->query('cityId');

        $countries = CountryGet::getCountriesByCityId( $cityId );

        $parsedCountries = self::parseCountries( $countries );

        return $parsedCountries;
    }

    private static function parseCountries ( $countries ) {
        $parsedData = [];
        foreach ( $countries[0]['city'] as $country ) {
            $parsedData[] = $country['country'];
        }
        return $parsedData;
    }
}
