<?php

namespace App\Http\Controllers\Api;

use App\Modules\Country\CountryGet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    public function getCountriesByCityId ( Request $request) {
        try {
            $cityId = $request->query('cityId');

            $countries = CountryGet::getCountriesByCityId( $cityId );

            $parsedCountries = self::parseCountries( $countries );

            return [
                'status' => 'success',
                'parsedData' => $parsedCountries
            ];
        } catch ( \Exception $e ) {
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            Log::error('Message: ' . $e->getMessage());
            return false;
        }
    }

    private static function parseCountries ( $countries ) {
        $parsedData = [];
        foreach ( $countries[0]['city'] as $country ) {
            $parsedData[] = $country['country'];
        }
        return $parsedData;
    }
}
