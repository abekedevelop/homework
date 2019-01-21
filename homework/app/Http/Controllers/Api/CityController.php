<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\City\CityGet;

class CityController extends Controller
{
    public function getCities () {
        $cities = CityGet::getCities();

        if ( $cities !== false ) {
            return [
                'status' => 'success',
                'cities' => $cities
            ];
        }
        return false;
    }
}
