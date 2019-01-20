<?php
/**
 * Created by PhpStorm.
 * User: Absat
 * Date: 20.01.2019
 * Time: 1:26
 */

namespace App\Modules\City;



use App\Models\City;

class CityGet
{
    public static function getCities () {
        try {
            return City::where(['city_has_connection' => 1])->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}