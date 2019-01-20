<?php
/**
 * Created by PhpStorm.
 * User: Absat
 * Date: 20.01.2019
 * Time: 13:50
 */

namespace App\Modules\Country;


use App\Models\City;
use App\Models\Country;

class CountryGet
{
    static function getCountriesByCityId ( $cityId ) {
        try {
            return City::where([ 'id' => $cityId ])->with('city.country')->get();
        } catch ( \Exception $e ) {
            return $e->getMessage();
        }
    }
}