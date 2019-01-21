<?php
/**
 * Created by PhpStorm.
 * User: Absat
 * Date: 20.01.2019
 * Time: 1:26
 */

namespace App\Modules\City;



use App\Models\City;
use Illuminate\Support\Facades\Log;

class CityGet
{
    public static function getCities () {
        try {
            return City::where(['city_has_connection' => 1])->get();
        } catch (\Exception $e) {
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            Log::error('Message: ' . $e->getMessage());
            return false;
        }
    }
}